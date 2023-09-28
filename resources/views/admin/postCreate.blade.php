@extends('admin.layouts.app')


@section('page_title') Добавление нового поста @endsection


@section('content')

<style>
    .table-action {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .table-action__btn-edit {
        width: 50px;
    }
    .table-action__btn-delete {
        width: 50px;
        margin-top: 0 !important;
        margin-left: 10px;
    }
</style>

    
<div class="row">
    <div class="col-12">
        {{-- {{ print_r(explode('.', request()->route()->getName())) }} --}}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin-bottom: 0px">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card card-primary">
            <div class="card-header">
            <h3 class="card-title">Создание поста</h3>
            </div>

            
            <form method="POST" action="{{ route('admin.post.create') }}" enctype="multipart/form-data">
                @CSRF
                <div class="card-body">
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Заголовок поста">
                    </div>
                   
                    {{-- <div class="form-group">
                        <label for="exampleInputFile">Картинка</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Выберите картинку</label>
                            </div>
                            
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <label for="exampleInputFile">Картинка (Формат: jpg, png)</label>
                        <div class="input-group">
                            <div class="custom-files">
                                <input type="file" name="image">
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-3">
                            <div class="form-group">
                                <label>Раздел</label>
                                <select class="form-control menu" name="menu">
                                    <option value="0">Выберите раздел</option>
                                    @if ($menu)
                                        @foreach ($menu as $m)
                                            <option value="{{$m->id}}" {{ $m->id == old('menu') ? 'selected' : ''}}>{{ $m->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Подраздел</label>
                                <input type="hidden" name="oldsubmenu" value="{{old('submenu')}}">
                                <select class="form-control submenu" name="submenu" disabled>
                                    <option value="0">Выберите подраздел</option>
                                    {{-- @if (old('submenu'))
                                        @foreach ($submenu as $sm)
                                            <option value="{{$sm->id}}" {{ $sm->id == old('submenu') ? 'selected' : ''}} >{{ $sm->title }}</option>
                                        @endforeach                                        
                                    @endif --}}
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Категория</label>
                                <select class="form-control" name="category">
                                    <option value="0">Выберите категорию</option>
                                    @if ($categories)
                                        @foreach ($categories as $cat)
                                            <option value="{{$cat->id}}" {{ $cat->id == old('category') ? 'selected' : ''}} >{{ $cat->title }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Авторы</label>
                                {{-- @dd(old('authors')) --}}
                                <div class="select2-purple">
                                    <select name="authors[]" class="select2 select-author select2-hidden-accessible" multiple="" data-placeholder="Выберите авторов" data-dropdown-css-class="select2-purple" style="width: 100%;" data-select2-id="15" tabindex="-1" aria-hidden="true">
                                        @if ($authors)
                                            @foreach ($authors as $author)
                                                <option value="{{$author->id}}" {{  old('authors') && in_array($author->id, old('authors'))  ? 'selected' : ''}} >{{ $author->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                           
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline card-outline-tabs">
                                <div class="card-header p-0 border-bottom-0">
                                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Таб 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Таб 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Таб 3</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Таб 4</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-four-tabContent">
                                        <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                            <div class="form-group">
                                                <label for="exampleInputtext1">Название таба</label>
                                                <input name="tab1_title" value="{{ old('tab1_title') }}" type="text" class="form-control" id="exampleInputtext1" placeholder="Название таба">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание</label>
                                                <textarea name="tab1_desc" class="form-control" rows="3" placeholder="Пишите...">{{ old('tab1_desc') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                            <div class="form-group">
                                                <label for="exampleInputtext1">Название таба</label>
                                                <input name="tab2_title" value="{{ old('tab2_title') }}" type="text" class="form-control" id="exampleInputtext1" placeholder="Название таба">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание</label>
                                                <textarea name="tab2_desc" class="form-control" rows="3" placeholder="Пишите...">{{ old('tab2_desc') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                            <div class="form-group">
                                                <label for="exampleInputtext1">Название таба</label>
                                                <input name="tab3_title" value="{{ old('tab3_title') }}" type="text" class="form-control" id="exampleInputtext1" placeholder="Название таба">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание</label>
                                                <textarea name="tab3_desc" class="form-control" rows="3" placeholder="Пишите...">{{ old('tab3_desc') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade " id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                            <div class="form-group">
                                                <label for="exampleInputtext1">Название таба</label>
                                                <input name="tab4_title" value="{{ old('tab4_title') }}" type="text" class="form-control" id="exampleInputtext1" placeholder="Название таба">
                                            </div>
                                            <div class="form-group">
                                                <label>Описание</label>
                                                <textarea name="tab4_desc" class="form-control" rows="3" placeholder="Пишите...">{{ old('tab4_desc') }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
        
                            </div>
                        </div>
                    </div>
                    
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>

    </div>
</div>
            
<script>

    document.addEventListener('DOMContentLoaded', () => {

        let selectMenu = document.querySelector('.menu');
        let selectSubmenu = document.querySelector('.submenu');
        const oldsubmenu = document.querySelector('input[name="oldsubmenu"]').value;


        if(selectMenu.value != 0) {
            // console.log('default value');

            const oldsubmenu = document.querySelector('input[name="oldsubmenu"]').value;

            const form = {id: selectMenu.value};

            fetchMenu(selectSubmenu, form);
            selectSubmenu.disabled = false
        }


        selectMenu.addEventListener('change', function(e) {
            console.log('change', this.value);

            const form = {id: this.value};

            fetchMenu(selectSubmenu, form);

        });


        function fetchMenu(selectSubmenu, form) {
            if(this.value == 0) {
                selectSubmenu.disabled = true
                selectSubmenu.value = 0

                return;
            }else {
                selectSubmenu.disabled = false
            }


            fetch("{{ route('admin.posts.getsubmenu') }}",{
                method: 'POST',
                body: JSON.stringify(form),
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }
            ).then(resp => {return resp.json()}).then(resBody => {

                selectSubmenu.innerHTML = '';

                const option = document.createElement( 'option' );
                    option.value = 0;
                    option.text = 'Выберите подраздел';

                selectSubmenu.appendChild(option);


                resBody.submenu.forEach(element => {
                    const option = document.createElement( 'option' );
                    option.value = element.id;
                    option.text = element.title;

                    selectSubmenu.appendChild(option)

                    if(oldsubmenu && oldsubmenu != 0) {
                        console.log('oldsubmenu', oldsubmenu);
                        
                        selectSubmenu.value = oldsubmenu;
                    }
                });


            });
        }

    });

    

</script>

@endsection