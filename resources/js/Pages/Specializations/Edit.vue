<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('specializations')">Специализации</inertia-link>
      <span class="text-indigo-400 font-medium">/Создать</span>
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <div class="bg-white border-none w-full px-8 ml-1 text-md flex justify-end items-center" >
        <button class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300" v-bind:class="(current_locale == lang) ? 'bg-red-600' :'bg-indigo-600'" v-for="lang of langs" :value="lang" v-on:click="changeLang($event)" :key="lang">{{lang}}</button>
      </div>          
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <template v-for="lang of langs" >
          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'pr-6'" :key="'name-'+lang"> 
            <text-input v-model="form.name[lang]" :errors="error_msg['name.'+lang]" class="pb-8 pr-6 w-full" label="Наименование"/>
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'name', form.name[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>          
          </template>
          <div class="flex w-full pr-6 pb-8" > 
            <toggle-button v-model="form.type"
              :sync="true"
              :labels="{checked: 'Для участника', unchecked: 'Для торгового места'}"
              :width="230"
              :height="40"
              :font-size="16"
              :color="{checked: '#63B3ED', unchecked: '#68D391', disabled: '#CCCCCC'}"/> 
          </div>           
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
import {ToggleButton} from 'vue-js-toggle-button'

export default {
  metaInfo: { title: 'Изменить специализацию' },
  layout: Layout,
  components: {
    LoadingButton,
    TextInput,
    ToggleButton,
  },
 
  props: {
    specialization: Object,  
  },
  remember: {
    data: ['form'],
  },

  data() {
    return {
      current_locale:'',
      sending: false,
      form: {
        name: JSON.parse(this.specialization.name),
        type: this.specialization.type!=0 ?true :false,
      },
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
      this.$inertia.put(this.route('specializations.update', this.specialization.id), this.form)
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