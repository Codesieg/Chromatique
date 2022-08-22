@extends ('layout')

@section('contenu')

    <!-- Mangas Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>Tous Les Mangas</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="product__page__filter">
                                        <p>Order by:</p>
                                        <select>
                                            <option value="">A-Z</option>
                                            <option value="">1-10</option>
                                            <option value="">10-50</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        @foreach ($listMangas as $manga)
                                <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="<?= asset('storage/mangas/') ?>{{$manga->manga_directory .'/'. $manga->manga_cover }}">
                                            <!-- TODO <div class="ep">18 / 18</div> -->
                                            <!-- TODO <div class="comment"><i class="fa fa-comments"></i> 11</div>
                                            <div class="view"><i class="fa fa-eye"></i> 9141</div> -->
                                        </div>
                                        <div class="product__item__text">
                                            <!-- TODO <ul>
                                                <li>Active</li>
                                                <li>Shonen</li>
                                            </ul> -->
                                            <h5><a href="{{route('browse_tomes', ['id' => $manga->id]) }}">{{$manga->manga_name}}</a></h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach     
                        </div>
                    </div>
                    <div class="product__pagination">
                        <a href="#" class="current-page">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#"><i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>             
            </div>
        </div>
    </div>

</div>
</div>
</div>
</section>
<!-- Product Section End -->
@endsection