<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Consultant\StoreConsultantRequest;
use App\Http\Requests\Consultant\UpdateConsultantRequest;
use App\Http\Requests\Contact\StoreAnswerRequest;
use App\Http\Requests\Faq\StoreFaqRequest;
use App\Http\Requests\Faq\UpdateFaqRequest;
use App\Http\Requests\StoreAuthorRequest;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\StoreSubSectionRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Http\Requests\UpdateSubSectionRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\Distribution as MailDistribution;
use App\Models\Author;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Consultant;
use App\Models\ContactForm;
use App\Models\Distribution;
use App\Models\Faq;
use App\Models\Menu;
use App\Models\Post;
use App\Models\ReplyContact;
use App\Models\Submenu;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    // Главная страница админки
    public function mainPage() {
        $info = ['posts' => Post::count(), 'users' => User::count(), 'subscribers' => Subscriber::count(), 'questions_count' => ContactForm::all()->count()];

        return view('admin.main', compact('info'));
    }

    // Раздел 
    public function sectionPage() {
        $sections = Menu::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.section', compact('sections'));
    }

    public function sectionCreatePage() {
        return view('admin.pages.section.sectionCreate');
    }

    public function sectionCreate(StoreSectionRequest $request) {
        // $post = new Post();

        // Если есть файл
        if( $request->hasFile('image')){
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/section/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);
        }
        
        // При выводе файла на странице нудно будет прибавить в начале "storage/"
        $urlImage = $fileNameToStore;

        // dd($urlImage);
        
        $newSection = Menu::create([
            'title' => $request->title,
            'image' => $urlImage,
            'content' => $request->content,
        ]);

        if(!$newSection) {
            dd('error');
        }

        session()->flash('success', "Раздел успешно создан!");

        return redirect()->route('admin.section.all');
    }

    public function sectionEditPage($id) {
        $section = Menu::find($id);

        return view('admin.pages.section.sectionEdit', compact('section'));
    }

    public function sectionUpdate(UpdateSectionRequest $request) {

        $section = Menu::find($request->id);

        $urlImage = $section->image;

        // Если есть файл
        if( $request->hasFile('image')){
            $prevImage = $section->image;
            
            if(Storage::disk('public')->exists($prevImage)){
                Storage::delete('public/'. $prevImage);
            }

            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/section/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);

            $urlImage = $fileNameToStore;
        }

        $section->update([
            'title' => $request->title,
            'image' => $urlImage,
            'content' => $request->content,
        ]);

        session()->flash('success', "Раздел успешно обновлен!");

        return redirect()->back();
    }

    public function sectionRemove(Request $request) {

        $section = Menu::find($request->id);

        if($section) {
            $section->delete();
            session()->flash('success', "Раздел успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }


    // Подраздел
    public function subSectionPage() {
        $subsections = Submenu::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.subsection', compact('subsections'));
    }

    public function subSectionCreatePage() {
        $menu = Menu::all();

        return view('admin.pages.section.subsectionCreate', compact('menu'));
    }

    public function subSectionCreate(StoreSubSectionRequest $request) {

        // Если есть файл
        if( $request->hasFile('image')){
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/subsection/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);
        }
        
        // При выводе файла на странице нудно будет прибавить в начале "storage/"
        $urlImage = $fileNameToStore;

        // dd($urlImage);
        
        $newSection = Submenu::create([
            'title' => $request->title,
            'icon' => $urlImage,
            'parent_id' => $request->menu,
        ]);

        if(!$newSection) {
            dd('error');
        }

        session()->flash('success', "Подраздел успешно создан!");

        return redirect()->route('admin.section.all');
    }

    public function subSectionEditPage($id) {
        $section = Submenu::find($id);
        $menu = Menu::all();

        return view('admin.pages.section.subsectionEdit', compact('section', 'menu'));
    }

    public function subSectionUpdate(UpdateSubSectionRequest $request) {

        $section = Submenu::find($request->id);

        $urlImage = $section->icon;

        // Если есть файл
        if( $request->hasFile('image')){
            $prevImage = $section->icon;
            
            if(Storage::disk('public')->exists($prevImage)){
                Storage::delete('public/'. $prevImage);
            }

            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/subsection/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);

            $urlImage = $fileNameToStore;
        }

        $section->update([
            'title' => $request->title,
            'icon' => $urlImage,
            'parent_id' => $request->menu,
        ]);

        session()->flash('success', "Подраздел успешно обновлен!");

        return redirect()->back();
    }

    public function subSectionRemove(Request $request) {

        $subSection = Submenu::find($request->id);

        if($subSection) {
            $subSection->delete();
            session()->flash('success', "Подраздел успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }


    // Категория
    public function categoryPage() {
        $categories = Category::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.category', compact('categories'));
    }

    public function categoryCreatePage() {
        $categories = Category::all();

        return view('admin.pages.category.categoryCreate', compact('categories'));
    }

    public function categoryCreate(StoreCategoryRequest $request) {

        $newCategory = Category::create([
            'title' => $request->title,
        ]);

        if(!$newCategory) {
            dd('error');
        }

        session()->flash('success', "Категория успешно создана!");

        return redirect()->route('admin.category.all');
    }

    public function categoryEditPage($id) {
        $category = Category::find($id);

        return view('admin.pages.category.categoryEdit', compact('category'));
    }

    public function categoryUpdate(StoreCategoryRequest $request) {

        $category = Category::find($request->id);

        $category->update([
            'title' => $request->title,
        ]);

        session()->flash('success', "Категория успешно обновлена!");

        return redirect()->back();
    }

    public function categoryRemove(Request $request) {

        $category = Category::find($request->id);

        if($category) {
            $category->delete();
            session()->flash('success', "Категория успешно удалена!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }


    // Пост
    public function postPage() {
        $posts = Post::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.post', compact('posts'));
    }

    public function postEditPage($id) {
        $post = Post::find($id);
        $categories = Category::all();
        $menu = Menu::all();
        $submenu = Submenu::all();
        $authors = Author::all();

        return view('admin.postEdit', compact('post', 'categories', 'menu', 'submenu', 'authors'));
    }

    public function postCreatePage(Request $request) {
        $posts = Post::all();
        $categories = Category::all();
        $menu = Menu::all();
        $submenu = Submenu::all();
        $authors = Author::all();

        return view('admin.postCreate', compact('posts', 'categories', 'menu', 'submenu', 'authors'));
    }

    public function postCreate(StorePostRequest $request) {
        $post = new Post();

        // Если есть файл
        if( $request->hasFile('image')){
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);
        }
        $urlImage = $fileNameToStore;

        $newPost = $post->create([
            'title' => $request->title,
            'image' => $urlImage,
            'menu_id' => $request->menu,
            'submenu_id' => $request->submenu,
            'category_id' => $request->category,
            'tab1_title' => $request->tab1_title,
            'tab2_title' => $request->tab2_title,
            'tab3_title' => $request->tab3_title,
            'tab4_title' => $request->tab4_title,
            'tab1_desc' => $request->tab1_desc,
            'tab2_desc' => $request->tab2_desc,
            'tab3_desc' => $request->tab3_desc,
            'tab4_desc' => $request->tab4_desc,
        ]);
        $newPost->authors()->attach($request->authors);

        if(!$newPost) {
            dd('error');
        }

        session()->flash('success', "Пост успешно создан!");

        return redirect()->route('admin.posts.all');
    }

    public function postUpdate(UpdatePostRequest $request) {
        $post = Post::find($request->post_id);
        $urlImage = $post->image;

        // Если есть файл
        if( $request->hasFile('image')){
            $prevImage = $post->image;
            
            if(Storage::disk('public')->exists($prevImage)){
                Storage::delete('public/'. $prevImage);
            }
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);

            $urlImage = $fileNameToStore;
        }
        
        $updatedPost = $post->update([
            'title' => $request->title,
            'image' => $urlImage,
            'menu_id' => $request->menu,
            'submenu_id' => $request->submenu,
            'category_id' => $request->category,
            'tab1_title' => $request->tab1_title,
            'tab2_title' => $request->tab2_title,
            'tab3_title' => $request->tab3_title,
            'tab4_title' => $request->tab4_title,
            'tab1_desc' => $request->tab1_desc,
            'tab2_desc' => $request->tab2_desc,
            'tab3_desc' => $request->tab3_desc,
            'tab4_desc' => $request->tab4_desc,
        ]);

        $post->authors()->sync($request->authors);
        session()->flash('success', "Пост успешно обновлен!");

        return redirect()->back();
    }

    public function postRemove(Request $request) {
        $post = Post::find($request->id);

        if($post) {
            $post->delete();
            session()->flash('success', "Пост успешно удален!");

            return response()->json([
                'status' => true,
            ],200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ],404);
    }


    // Автор
    public function authorPage() {
        $authors = Author::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.author', compact('authors'));
    }

    public function authorCreatePage() {
        return view('admin.pages.author.authorCreate');
    }

    public function authorCreate(StoreAuthorRequest $request) {

        $newAuthor = Author::create([
            'name' => $request->name,
        ]);

        if(!$newAuthor) {
            dd('error');
        }

        session()->flash('success', "Автор успешно создан!");

        return redirect()->route('admin.author.all');
    }

    public function authorEditPage($id) {
        $author = Author::find($id);

        return view('admin.pages.author.authorEdit', compact('author'));
    }

    public function authorUpdate(StoreAuthorRequest $request) {

        $author = Author::find($request->id);

        $author->update([
            'name' => $request->name,
        ]);

        session()->flash('success', "Автор успешно обновлен!");

        return redirect()->back();
    }

    public function authorRemove(Request $request) {

        $author = Author::find($request->id);

        if($author) {
            $author->delete();
            session()->flash('success', "Автор успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }


    // Пользователь
    public function userPage() {
        $users = User::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.user', compact('users'));
    }

    public function userEditPage($id) {
        $user = User::find($id);

        return view('admin.pages.user.userEdit', compact('user'));
    }

    public function userUpdate(UpdateUserRequest $request) {
        $user = User::find($request->id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password == Hash::make($request->password) ? $user->password : Hash::make($request->password),
            'is_admin' => $request->admin == 'on' ? 1 : 0
        ]);

        session()->flash('success', "Пользователь успешно обновлен!");

        return redirect()->back();
    }

    public function userCreatePage() {
        return view('admin.pages.user.userCreate');
    }

    public function userCreate(StoreUserRequest $request) {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('success', "Пользователь успешно создан!");

        return redirect()->route('admin.user.all');
    }

    public function userRemove(Request $request) {

        $user = User::find($request->id);

        if($user) {
            $user->delete();
            session()->flash('success', "Пользователь успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }

    // Подписчики
    public function subscribePage() {
        $subscribers = Subscriber::paginate(6);

        return view('admin.pages.subscriber.subscriber', compact('subscribers'));
    }

    public function subscribeMailPage() {
        $subscribers = Subscriber::paginate(6);
        $menu = Menu::all();

        return view('admin.pages.subscriber.mail', compact('subscribers', 'menu'));
    }

    public function subscribeRemove(Request $request) {

        $subscribe = Subscriber::find($request->id);

        if($subscribe) {
            $subscribe->delete();
            session()->flash('success', "Подписчик успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }


    // Рассылки
    public function distributionPage() {
        $distributions = Distribution::orderBy('id', 'DESC')->paginate(6);

        // dd($distributions[0]->section);

        return view('admin.pages.subscriber.distribution', compact('distributions'));
    }

    public function distributionStore(Request $request) {
        

        if(!$request->menu) {
            return redirect()->back()->with(['error'=> 'Выберите раздел']);
        }

        $menu = Menu::find($request->menu);
        
        // dd($menu->subscribers);
        if($menu->subscribers) {
            foreach($menu->subscribers as $subscriber) {
                Mail::to($subscriber['email'])->send(new MailDistribution($request));
            }

            Distribution::create([
                'menu_id' => $menu->id,
            ]);
        }
        

        return redirect()->back();
    }




    // Баннеры
    public function bannerPage() {
        $banners = Banner::orderBy('banner_order', 'ASC')->Paginate(6);

        return view('admin.pages.banner.banner', compact('banners'));
    }

    public function bannerCreatePage() {
        return view('admin.pages.banner.bannerCreate');
    }

    public function bannerCreate(StoreBannerRequest $request) {

        // Если есть файл
        if( $request->hasFile('image')){
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/banners/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);
        }
        
        // При выводе файла на странице нудно будет прибавить в начале "storage/"
        $urlImage = $fileNameToStore;

        // dd($urlImage);
        
        $newBanner = Banner::create([
            'link' => $request->link,
            'image' => $urlImage,
        ]);

        if($newBanner) {
            session()->flash('success', "Баннер успешно создан!");
        }
        return redirect()->route('admin.banner.all');
        
    }

    public function bannerEditPage($id) {
        $banner = Banner::findOrFail($id);
        
        return view('admin.pages.banner.bannerEdit', compact('banner'));
    }

    public function bannerUpdate(UpdateBannerRequest $request) {
        $banner = Banner::find($request->banner_id);
        $urlImage = $banner->image;

        // Если есть файл
        if( $request->hasFile('image')){
            $prevImage = $banner->image;
            
            if(Storage::disk('public')->exists($prevImage)){
                Storage::delete('public/'. $prevImage);
            }
            // Имя и расширение файла
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Только оригинальное имя файла
            $filename = str()->slug(pathinfo($filenameWithExt, PATHINFO_FILENAME));
            // Расширение
            $extention = $request->file('image')->getClientOriginalExtension();
            // Путь для сохранения
            $fileNameToStore = "image/banners/".$filename."_".time().".".$extention;
            // Сохраняем файл
            $path = $request->file('image')->storeAs('public/', $fileNameToStore);

            $urlImage = $fileNameToStore;
        }
        
        $banner->update([
            'link' => $request->link,
            'image' => $urlImage,
            'banner_order' => $request->banner_order,
        ]);

        session()->flash('success', "Баннер успешно обновлен!");

        return redirect()->back();
    }


    public function bannerRemove(Request $request) {

        $banner = Banner::find($request->id);

        if($banner) {
            $banner->delete();
            session()->flash('success', "Баннер успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }
   

    // Контакт форма
    public function contactPage() {
        $questions = ContactForm::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.pages.contact.form.form', compact('questions'));
    }

    public function contactMailPage($id) {
        $question = ContactForm::findOrFail($id);

        return view('admin.pages.contact.form.mail', compact('question'));
    }

    public function contactMailClose($id) {
        $question = ContactForm::findOrFail($id);
        $question->status = 1;
        $question->save();

        return redirect()->back();
    }


    public function contactMailStore(StoreAnswerRequest $request) {
        
        $user_id = Auth::id() ?? 1;

        $menu = ContactForm::findOrFail($request->id)->replies()->create([
            'user_id' => $user_id,
            'message' => $request->message,
            // 'question_id' => $user_id,
        ]);
        
        
        
        

        return redirect()->back();
    }



    public function contactRemove(Request $request) {

        $contact = ContactForm::find($request->id);

        if($contact) {
            $contact->delete();
            session()->flash('success', "Вопрос успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }


    // FAQ
    public function faqPage() {
        $faqs = Faq::orderBy('id', 'DESC')->Paginate(6);

        // dd($faqs);
        return view('admin.pages.faq.index', compact('faqs'));
    }

    public function faqCreatePage() {
        return view('admin.pages.faq.faqCreate');
    }

    public function faqCreate(StoreFaqRequest $request) {

        Faq::create([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        session()->flash('success', "Вопрос успешно создан!");

        return redirect()->route('admin.faq.all');
    }

    public function faqEditPage($id) {
        $faq = Faq::findOrFail($id);
        
        return view('admin.pages.faq.faqEdit', compact('faq'));
    }

    public function faqUpdate(UpdateFaqRequest $request) {
        $faq = Faq::find($request->id);

        $faq->update([
            'title' => $request->title,
            'desc' => $request->desc,
        ]);

        session()->flash('success', "Вопрос успешно обновлен!");

        return redirect()->back();
    }


    public function faqRemove(Request $request) {

        $faq = Faq::find($request->id);

        if($faq) {
            $faq->delete();
            session()->flash('success', "Вопрос успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }


    // Consultant
    public function consultantPage() {
        $consultants = Consultant::orderBy('id', 'DESC')->Paginate(6);

        return view('admin.pages.consultant.index', compact('consultants'));
    }

    public function consultantEditPage($id) {
        $consultant = Consultant::findOrFail($id);
        
        return view('admin.pages.consultant.consultantEdit', compact('consultant'));
    }

    public function consultantUpdate(UpdateConsultantRequest $request) {
        $consultant = Consultant::find($request->id);

        $consultant->update([
            'name' => $request->name,
        ]);

        session()->flash('success', "Консультант успешно обновлен!");

        return redirect()->back();
    }

    public function consultantCreatePage() {
        return view('admin.pages.consultant.consultantCreate');
    }

    public function consultantCreate(StoreConsultantRequest $request) {

        Consultant::create([
            'name' => $request->name,
        ]);

        session()->flash('success', "Консультант успешно создан!");

        return redirect()->route('admin.consultant.all');
    }

    public function consultantRemove(Request $request) {

        $consultant = Consultant::find($request->id);

        if($consultant) {
            $consultant->delete();
            session()->flash('success', "Консультант успешно удален!");

            return response()->json([
                'status' => true,
            ], 200);
        }

        return response()->json([
            'status' => false,
            'id' => $request->id
        ], 404);
    }



    // Аякс подгрузка подраздела
    public function getSubMenuAjax(Request $request) {
        
        if($request->id == 0) {
            return response()->json('error', 404);
        }

        $menu = Menu::find($request->id);

        return response()->json([
            'submenu' => $menu->submenu
        ], 200);

    }

}
