use App\Models\Contact;
use App\Models\Category;

public function index(Request $request)
{
    // カテゴリー一覧を取得（検索のプルダウン用）
    $categories = Category::all();

    // クエリビルダを用意
    $query = Contact::query();

    // ここで必要に応じて検索条件を絞り込み

    $contacts = $query->paginate(10)->withQueryString();

    return view('admin.contacts.index', compact('contacts', 'categories'));
}
