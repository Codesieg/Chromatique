@extends ('layout')

@section('contenu')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>Adventure</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- User Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="<?= public_path('assets/img/avatar/avatarDefault.png') ?>">
                            <div class="comment"><i class="fa fa-comments"></i> 11</div>
                            <div class="view"><i class="fa fa-eye"></i> 9141</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $user->name }}</h3>
                            </div>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type :</span>Shomen</li>
                                            <li><span>Autheur :</span></li>
                                            <li><span>Date d'ajout :</span></li>
                                            <li><span>Status :</span> En cours</li>
                                            <li><span>Genre :</span> Action, Adventure, Fantasy, Magic</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Scores :</span> 7.31 / 1,515</li>
                                            <li><span>Votes :</span> 8.5 / 161 times</li>
                                            <li><span>Vues :</span> 131,541</li>
                                            <li><span>Colorisé par :</span> Sardan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a href="#" class="follow-btn"><i class="fa fa-heart-o"></i> Suivre</a>
                                {{-- <a href="#" class="watch-btn"><span>Watch Now</span> <i
                                    class="fa fa-angle-right"></i></a> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- Anime Section End -->
@endsection