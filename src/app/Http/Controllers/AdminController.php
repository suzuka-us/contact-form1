namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::query();

        // 1. 名前（部分一致・フルネーム対応）
        if ($request->filled('name')) {
            $name = $request->input('name');
            $query->where(function ($q) use ($name) {
                $q->where('last_name', 'like', "%{$name}%")
                  ->orWhere('first_name', 'like', "%{$name}%")
                  ->orWhereRaw("CONCAT(last_name, first_name) like ?", ["%{$name}%"]);
            });
        }

        // 2. メールアドレス
        if ($request->filled('email')) {
            $email = $request->input('email');
            $query->where('email', 'like', "%{$email}%");
        }

        // 3. 性別
        if ($request->filled('gender') && $request->gender !== 'all') {
            $query->where('gender', $request->gender);
        }

        // 4. お問い合わせ種類
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 5. 日付
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $contacts = $query->paginate(7)->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }

    // 詳細表示（モーダル用JSON返却）
    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    // 削除処理
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(['message' => '削除しました']);
    }

    // CSVエクスポート
    public function export(Request $request): StreamedResponse
    {
        $query = Contact::query();

        // 検索条件はindexと同じ処理で再利用可能にしても良いです。
        // 省略しますが、$requestの検索条件をここでも適用してください。

        $contacts = $query->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=contacts.csv',
        ];

        $callback = function () use ($contacts) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', '名前', 'メール', '性別', 'お問い合わせ種類', '作成日']);
            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->email,
                    $contact->gender,
                    $contact->category->name ?? '',
                    $contact->created_at->format('Y-m-d'),
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
