<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('languages')">Языки</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name_ru }}
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <div class="bg-white border-none w-full p-4 md:py-0 md:px-8 text-md md:text-md flex justify-end items-center" >
        <button class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300" v-bind:class="(current_locale == lang) ? 'bg-red-600' :'bg-indigo-600'" v-for="lang of langs" :value="lang" v-on:click="changeLang($event)">{{lang}}</button>
      </div>          
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <div class="flex flex-wrap w-full lg:w-1/2" v-for="lang of langs" v-show="lang == current_locale" > 
            <text-input v-model="form.name[lang]" :errors="error_msg['name.'+lang]" class="pb-8" v-bind:class="(defaultlocale == lang) ? 'pr-6 w-full' :'w-6/7 lg:w-5/6 lg:pr-6'"label="Наименование" />
            <button v-show="lang != defaultlocale"class="bg-red-600 w-10 h-10 rounded ml-6 mt-6 lg:ml-0 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'name', form.name[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>          
          <text-input v-model="form.code" :errors="$page.errors.code" class="pr-6 pb-8 w-full lg:w-1/2" label="Код" />
          <text-input v-model="form.encoding" :errors="$page.errors.encoding" class="pr-6 pb-8 w-full lg:w-1/2" label="Кодировка" />
          <label class="inline-flex items-center md:pb-5 lg:pb-0">
            <input type="checkbox" v-model="form.status" true-value="1" false-value="0" class="form-checkbox h-6 w-6 text-indigo-600 shadow-none border-indigo-600">
            <span class="ml-3 text-lg">Статус</span>
          </label>
          <label class="inline-flex items-center md:pb-5 lg:pb-0">
            <input type="checkbox" v-model="form.is_default" true-value="1" false-value="0" class="form-checkbox h-6 w-6 text-indigo-600 ml-6 active:shadow-none border-indigo-600">
            <span class="ml-3 text-lg">Язык по-умолчанию</span>
          </label>
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

export default {
  metaInfo: { title: 'Создать язык' },
  layout: Layout,
  components: {
    LoadingButton,
    TextInput,
  },
  props: {
    language: Object,
  },
  remember: 'form',
  data() {
    return {
      current_locale:'',
      sending: false,
      form: {
        name: JSON.parse(this.language.name),
        name_ru: this.language.name_ru,
        code: this.language.code,
        encoding: this.language.encoding,
        status: this.language.status,
        is_default: this.language.is_default,
      },
      error_msg:{},
  
    }
  },
  created() {
    this.current_locale = this.defaultlocale;
    var obj= new Object();
    this.langs.forEach(function(item, i, langs) {
      obj['name.'+item] = [];
       return obj;
    });

    this.error_msg = obj;
  },  

  watch: {
    '$page.errors': function (val, oldVal) {
      const objectArray = Object.entries(val);
      var ob = {};
      objectArray.forEach(([key, value]) => {
        if (key.indexOf('name') == 0){
          this.error_msg[key]= value
        }
      })
    },
  },
  methods: {
    submit() {
      this.sending = true
      this.$inertia.put(this.route('languages.update', this.language.id), this.form)
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
        this[prefix][input][currentLang] = response.data[0].toUpperCase() + response.data.substr(1);
      });      
    },    
  },
}
</script>
<style scope>

</style>