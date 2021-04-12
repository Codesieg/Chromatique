@extends ('layout.blade.php');

@section('contenu')

    <!-- wrap -->
    <main class="main">
        <div class="search">
            <fieldset class="field-container">
                <input type="text" placeholder="Search..." class="st-default-search-input field" />
                <div class="icons-container">
                    <div class="icon-search"></div>
                </div>
            </fieldset>
            
        </div>
        <div class="content">
            <section class="cards">
                <a href="single.html">
                    <div class="card">
                        <img class="cover" src="assets/img/cover1.jpg" alt="">
                        
                        <h1 class="white">One piece</h1>
                        <p> Chapitre 1</p>
                    </div>
                </a>
                
            </section>

        <!-- cards -->
        <section class="main-cover">
            <div class="card">
                <img class="cover" src="assets/img/cover1.jpg" alt="">
                <!-- <div class="stats">
                    <div class="views">
                        <i class="las la-eye white"></i>
                        <p>150 Vues</p>
                    </div>
                    <div class="rating">
                        <i class="las la-star white"></i>
                        <i class="las la-star white"></i>
                        <i class="las la-star white"></i>
                        <i class="las la-star white"></i>
                        <i class="las la-star-half white"></i>
                        <p></p>
                    </div>
                </div> -->
                <!-- <p class="resume">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p> -->
            </div>
        </section>
        <!-- content-->
    </main>

@endsection