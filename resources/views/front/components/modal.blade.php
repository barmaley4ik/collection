<style>
.popup {
  display: -webkit-box;
  display: flex;
  -webkit-box-align: center;
          align-items: center;
  -webkit-box-pack: center;
          justify-content: center;
  position: fixed;
  width: 100vw;
  height: 100vh;
  bottom: 0;
  right: 0;
  background-color: #333333b5;
  z-index: 2;
  visibility: hidden;
  opacity: 0;
  overflow: hiden;
  -webkit-transition: 0.64s ease-in-out;
  transition: 0.64s ease-in-out;
  z-index: 10005;
}
.popup-inner {
  position: relative;
  bottom: -100vw;
  right: -100vh;
  display: -webkit-box;
  display: flex;
  -webkit-box-align: center;
          align-items: center;
  max-width: 800px;
  max-height: 600px;
  width: 40%;
  height: auto;
  background-color: #fff;
  -webkit-transform: rotate(32deg);
          transform: rotate(32deg);
  -webkit-transition: 0.64s ease-in-out;
  transition: 0.64s ease-in-out;
}

.popup__text {
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-direction: column;
  -webkit-box-pack: center;
          justify-content: flex-start;
  width: 100%;
  height: 100%;
  padding: 0.6rem;
}
.popup__text h1 {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 2rem;
  text-transform: uppercase;
  color: #0a0a0a;
  text-align: center;
  padding-top: 15px;
}
.popup__text a {
    font-size: 16px;
    color: black;
    line-height: 1.5;
    padding: 10px 20px;
    margin: 0;
}
.popup:target {
  visibility: visible;
  opacity: 1;
}
.popup:target .popup-inner {
  bottom: 0;
  right: 0;
  -webkit-transform: rotate(0);
          transform: rotate(0);
}
.popup__close {
  position: absolute;
  right: -1rem;
  top: -1rem;
  width: 3rem;
  height: 3rem;
  font-size: 12px;
  font-weight: 300;
  border-radius: 100%;
  background-color: #0a0a0a;
  z-index: 4;
  color: #fff;
  line-height: 3rem;
  text-align: center;
  cursor: pointer;
  text-decoration: none;
}

@media only screen and (min-width : 320px) and (max-width : 480px) {
  .popup__text {
    margin-top: auto;
  }   
  .popup__text h1 {
      font-size: 16px;
  }
  .popup-inner {
    width: 90%;
    
  }
  .row .col {
    padding:5 20;
  }
  .popupform-inner {
    width: 90%;
    overflow: scroll;
  }
  .popupform__close {
    left: 0.04rem;
    top: 0.09rem;
  }    
  }
</style>

    <div class="popup" id="popup">
      <div class="popup-inner">
        <div class="popup__text">
          <h1> {{ __('front.choose_fest') }}</h1>
          @php
              $locale = config('app.locale');
          @endphp
          @foreach ($festivals as $festival)
            <a href="{{ ($festival->is_default === 1) ? ($locale != 'ru' ? (config('app.url') . '/' . $locale) :config('app.url')) : localized_route('fest.home', [$festival->slug]) }}">
            <span>{{$festival->name}}</span>
            </a>
          @endforeach
          <br>

        </div>
        {{-- !!!!!!! обрати внимание на класс ссылки - для закрытия попапа !!!!!!!!!!! --}}
        <a class="popup__close" href="#">X</a>
      </div>
    </div>


<script type = "text/javascript">
        window.onload = function(){
            var ttoken = sessionStorage.getItem("ttoken");
            var token = "{{Request::session()->token()}}";
           // if (token !== ttoken) {
                var popup = document.getElementById("start_popup");
                setTimeout(popup.click(),5000);
                sessionStorage.setItem("ttoken",token);
           //   }            
        };	
</script>