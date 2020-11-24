<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('conditions')">Условия участия</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ JSON.parse(this.condition.festival.name)[defaultlocale] }}
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <div class="bg-white border-none w-full px-8 ml-1 text-md flex justify-end items-center" >
        <button class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300" v-bind:class="(current_locale == lang) ? 'bg-red-600' :'bg-indigo-600'" v-for="lang of langs" :value="lang" v-on:click="changeLang($event)" :key="lang">{{lang}}</button>
      </div>          
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
       
          <template v-for="lang of langs" >
          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'header-' + lang"> 
            <text-input v-model="form.header[lang]" :errors="error_msg['header.'+lang]" class="pb-8 pr-6 w-full" label="Заголовок (H1)" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'header', form.header[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>   
                      
          <div class="flex w-full flex-col pb-8 pr-6"  v-show="lang == current_locale" :key=" 'description' + lang "> 
            <label class="form-label">Текст:</label>
              
              <div class="w-full"  v-bind:class="(defaultlocale == lang) ? '' :'flex'">
                <editor :name="'description[' + lang + ']'" v-model="form.description[lang]" :init="{plugins: 'autolink lists hr anchor searchreplace visualblocks code insertdatetime media paste', language: 'ru', skin: 'oxide', branding: false, menubar: 'format', toolbar: 'styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | code '  }" />
                

                <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-10 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'description', form.description[defaultlocale])">

                <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
                </button>
            </div> 
            <div v-if="error_msg['description.'+lang]" class="form-error">{{ error_msg['description.'+lang][0] }}</div> 
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
          </div>                        
          </template>
          <select-input v-model="form.festival_id" class="pr-6 pb-8 w-full lg:w-1/2" :errors="error_msg['festival_id']" label="Фестивали">
            <option v-for="festival in fests" :key="festival.id" :value="festival.id" >{{ JSON.parse(festival.name)[defaultlocale] }}
            
            </option>
          
          </select-input>  
                              
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
import TextareaInput from '@/Shared/TextareaInput'


export default {
  metaInfo: { title: 'Редактирование условие участия' },
  layout: Layout,
  components: {
    LoadingButton,
    TextInput,
    Editor,
    Icon,
    SelectInput,
    TextareaInput,

  },
  props: {
    condition: Object,
    festivals: Array,     
  },
  remember: {
    data: ['form'],
  },

  data() {
    return {
      current_locale:'',
      sending: false,
      form: {
        header: JSON.parse(this.condition.header),
        description: JSON.parse(this.condition.description),
        meta_title: JSON.parse(this.condition.meta_title),
        meta_description: JSON.parse(this.condition.meta_description),
        festival_id: this.condition.festival_id,
      },
      fests: this.festivals,
      error_msg:{},
    }
  },
 
  created() {
    this.current_locale = this.defaultlocale;
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
      this.$inertia.put(this.route('conditions.update', this.condition.id), this.form)
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

</style>