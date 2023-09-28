@extends('admin.layouts.app')

@section('page_title') Dashboard @endsection

@section('content')

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $info['posts'] }}</h3>

              <p>Посты</p>
            </div>
            <div class="icon">
              <i class="ion ion-compose"></i>
            </div>
            <a href="{{ route('admin.posts.all') }}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $info['subscribers'] }}</h3>

              <p>Подписчики</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ route('admin.subscriber.all') }}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $info['users'] }}</h3>

              <p>Пользователи</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('admin.user.all') }}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $info['questions_count'] }}</h3>

              <p>Вопросы</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-chat"></i>
            </div>
            <a href="{{ route('admin.contact.all') }}" class="small-box-footer">Подробнее <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

@endsection