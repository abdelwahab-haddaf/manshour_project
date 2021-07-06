<footer class="container-fluid">
    <div class=" mt-2 mb-1 footer_div w-100">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-12 d-f">
                <a href="" class="col-6 m-auto"><img class="footer-img" src="{{(app()->getLocale() == 'ar')?asset('web/img/footer.png'):asset('web/img/en_logo_white.png')}}" alt=""></a>
                <ul class="footer-links col-lg-12 col-6">
                    <li><a class="social-m" href="{{\App\Models\Setting::where('key','instagram')->first()->value??'#'}}"><i class="fab fa-instagram"></i></a></li>
                    <li><a class="social-m" href="{{\App\Models\Setting::where('key','twitter')->first()->value??'#'}}"><i class="fab fa-twitter"></i></a></li>
                    <li><a class="social-m" href="{{\App\Models\Setting::where('key','facebook')->first()->value??'#'}}"><i class="fab fa-facebook-f"></i></a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-8 d-n">
                <p class="footer-p">{{\App\Models\Setting::where('key','footer_about_us')->first()->value??''}}</p>
            </div>
            <div class="col-lg-6 col-12 footer-email">
                <p class="footer-p col-lg-12 col-6"> <i class="fas fa-paper-plane ml-2"></i>{{__('web.User.email')}} : &nbsp; &nbsp;<span>{{\App\Models\Setting::where('key','email')->first()->value??'-'}}</span></p>
                <p class="footer-p col-lg-12 col-6"><i class="fas fa-phone ml-2"></i>{{__('web.User.mobile')}} :<span>&nbsp; &nbsp; {{\App\Models\Setting::where('key','mobile')->first()->value??'#'}}</span> </p>
            </div>
        </div>
        <hr class="m-0">
        <div class="row">
            <div class="col-lg-6 col-12">
                <ul class="sec-list m-0">
                    <li><a href="{{url('terms')}}"> {{__('web.terms_and_conditions')}} </a></li>
                    <li><a href="{{url('privacy')}}"> {{__('web.privacy_and_conditions')}} </a></li>
                    <li><a href="{{url('commission')}}"> {{__('web.site_commission')}} </a></li>
                    <li><a href="{{url('about')}}"> {{__('crud.Setting.Pages.About')}} </a></li>
                </ul>
            </div>
            <div class="col-lg-6 col-12">
                <p class="copyright m-0">Copyright &copy; 2020 <a href="">Mnshour</a> </p>
            </div>
        </div>
    </div>
</footer>
