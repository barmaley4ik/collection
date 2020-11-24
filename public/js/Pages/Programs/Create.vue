<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('programs')">Программы</inertia-link>
      <span class="text-indigo-400 font-medium">/Создать</span>
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <div class="bg-white border-none w-full px-8 ml-1 text-md flex justify-end items-center" >
        <button class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300" v-bind:class="(current_locale == lang) ? 'bg-red-600' :'bg-indigo-600'" v-for="lang of langs" :value="lang" v-on:click="changeLang($event)" :key="lang">{{lang}}</button>
      </div>          
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <label class="form-label" :for="'date-day'">Дата:</label>
            <date-pick
                v-model="form.day"
                :displayFormat="'DD.MM.YYYY'"
                :format= "'YYYY-MM-DD'"
                :inputAttributes="{readonly: true, required: true, id: 'date-day'}"
                :nextMonthCaption= "nextMonthCaption"
                :prevMonthCaption= "prevMonthCaption"
                :setTimeCaption= "setTimeCaption"
                :weekdays= "weekdays"
                :months= "months"
                :class="error_msg.day ? 'error form-input' :'form-input' "

            ></date-pick>
            <div v-if="error_msg.day" class="form-error">{{ error_msg.day[0] }}</div>
          </div>
          <select-input v-model="form.festival_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Фестивали">
            <option v-for="festival in fests" :key="festival.id" :value="festival.id">{{ JSON.parse(festival.name)[defaultlocale] }}</option>
          </select-input>
<!--           <div class="pr-6 pb-8 w-full lg:w-1/2">
            <label class="form-label" :for="'time_day_start'">Время начала:</label> 
            <vue-timepicker :input-class="error_msg['time_day_start'] ? 'form-input error' : 'form-input'" name="time_day_start" placeholder=" " input-width="100%" :minute-interval="5" :blur-delay="500" v-model="form.time_day_start" close-on-complete></vue-timepicker> 
            <div v-if="error_msg['time_day_start']" class="form-error" >{{ error_msg['time_day_start'][0] }}</div> 
          </div>
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <label class="form-label" :for="'time_day_end'">Время окончания:</label> 
            <vue-timepicker :input-class="error_msg['time_day_end'] ? 'form-input error' : 'form-input'" name="time_day_end" placeholder=" " input-width="100%" :minute-interval="5" :blur-delay="500" v-model="form.time_day_end" close-on-complete></vue-timepicker>
            <div v-if="error_msg['time_day_end']" class="form-error" >{{ error_msg['time_day_end'][0] }}</div> 
          </div>    -->                        
          <template v-for="lang of langs" >
          <div class="flex w-full flex-col pb-8 pr-6"  v-show="lang == current_locale" :key=" 'text_day' + lang "> 
            <label class="form-label">Текст:</label>
              
              <div class="w-full"  v-bind:class="(defaultlocale == lang) ? '' :'flex'">
                <editor :name="'text_day[' + lang + ']'" v-model="form.text_day[lang]" :init="{plugins: 'autolink lists link anchor searchreplace code paste', height: 400, language: 'ru', skin: 'oxide', branding: false, menubar: 'format', toolbar: 'styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | code link'  }" />
                

                <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-10 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'text_day', form.text_day[defaultlocale])">

                <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
                </button>
            </div> 
            <div v-if="error_msg['text_day.'+lang]" class="form-error">{{ error_msg['text_day.'+lang][0] }}</div> 
          </div>
<!--           <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'place_day-' + lang"> 
            <text-input v-model="form.place_day[lang]" :errors="error_msg['place_day.'+lang]" class="pb-8 pr-6 w-full" label="Место" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'place_day', form.place_day[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>
          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'meta_title-' + lang"> 
            <text-input v-model="form.meta_title[lang]" :errors="error_msg['meta_title.'+lang]" class="pb-8 pr-6 w-full" label="Title" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'meta_title', form.meta_title[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>
          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key=" 'meta_description' + lang ">   
            <textarea-input v-model="form.meta_description[lang]" :errors="error_msg['meta_description.'+lang]" class="pb-8 pr-6 w-full" label="Description"  />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'meta_description', form.meta_description[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>            
          </div>  -->                                             
          </template>
                               
        </div>                       
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
          <loading-button :loading="sending" class="btn-indigo text-white hover:bg-red-600 focus:bg-red-600" type="submit">Сохранить</loading-button>
        </div>
      </form>
    </div> 
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import TextInput from '@/Shared/TextInput'
import Editor from '@tinymce/tinymce-vue'
import Icon from '@/Shared/Icon'
import SelectInput from '@/Shared/SelectInput'
import DatePick from 'vue-date-pick'
import 'vue-date-pick/dist/vueDatePick.css'
/* import VueTimepicker from 'vue2-timepicker/src/vue-timepicker' */
import TextareaInput from '@/Shared/TextareaInput'

export default {
  metaInfo: { title: 'Создать фестиваль' },
  layout: Layout,
  components: {
    LoadingButton,
    TextInput,
    Editor,
    Icon,
    SelectInput,
    DatePick,
/*     VueTimepicker, */
    TextareaInput

  },
 
  props: {
    program: Object,
    festivals: Array,  
    nextMonthCaption: {type: String, default: 'Следующий месяц'},
    prevMonthCaption: {type: String, default: 'Предыдущий месяц'},
    setTimeCaption: {type: String, default: 'Выбрать время:'},
    weekdays: {
        type: Array,
        default: () => ([
            'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'
        ])
    },
    months: {
        type: Array,
        default: () => ([
            'Январь', 'Февраль', 'Март', 'Апрель',
            'Май', 'Июнь', 'Июль', 'Август',
            'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'
        ])
    },      
      
  },
  remember: {
    data: ['form'],
  },

  data() {
    return {
      current_locale:'',
      sending: false,
      form: {
        text_day: {},
        day: null,
        festival_id: (this.program === undefined) ? (this.festivals.length> 0 ? this.festivals[0].id : null) : this.program.festival_id,
/*         place_day: {},
        time_day_start: '',
        time_day_end: '',
        meta_title: {},
        meta_description: {}, */
      },
      fests: this.festivals,
      error_msg:{},
 
    }
  },
 
  created() {
    this.current_locale = this.defaultlocale;
    this.langs.forEach((item, i, langs)=> {

      Vue.set( this.form.text_day,item, '');
/*       Vue.set( this.form.place_day,item, '');
      Vue.set( this.form.meta_title,item, '');
      Vue.set( this.form.meta_description,item, ''); */

    });

  },  

  watch: {
    '$page.errors': function (val, oldVal) {
      const objectArray = Object.entries(val);
      objectArray.forEach(([key, value]) => {
          this.error_msg[key]= value

      })
    },
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia.post(this.route('programs.store'), this.form)
        .then(() => (this.sending = false))
    },
    changeLang: function(e) {
      this.current_locale = e.target.value;
    },
    translate(defaultLang, currentLang, prefix, input, textForTranslate) {
      this.fields.textTranslate = textForTranslate;
      this.fields.defaultLang = defaultLang;
      this.fields.currentLang = currentLang;
      this.axios.post(this.route('translate.index'), this.fields).then(response => {
     
          this[prefix][input][currentLang] = response.data;

      })      
    },
  },
}
</script>
<style scope>
.tox .tox-editor-header {
    z-index: 0 !important;
}
.vdpWithInput > input {
    font-size: 1rem !important;
}
.form-input.error, .form-textarea.error, .form-select.error {
    border-color: #e53e3e !important;
}
</style>