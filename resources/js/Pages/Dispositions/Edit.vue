<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('dispositions')">Схема размещения</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ JSON.parse(this.disposition.festival.name)[defaultlocale] }}  
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <div class="bg-white border-none w-full px-8 ml-1 text-md flex justify-end items-center" >
        <button class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300" v-bind:class="(current_locale == lang) ? 'bg-red-600' :'bg-indigo-600'" v-for="lang of langs" :value="lang" v-on:click="changeLang($event)" :key="lang">{{lang}}</button>
      </div>          
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
         
          <template v-for="lang of langs" >
      
          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'pr-6'" :key="'meta_title-' + lang"> 
            <text-input v-model="form.meta_title[lang]" :errors="error_msg['meta_title.'+lang]" class="pb-8 pr-6 w-full" label="Title" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-6 mt-6 lg:ml-0 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'meta_title', form.meta_title[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>
          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'pr-6'" :key="'meta_description-' + lang">  
          <textarea-input v-model="form.meta_description[lang]" :errors="$page.errors.meta_description" class="pr-6 pb-8 w-full" label="Description"/>
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-6 mt-6 lg:ml-0 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'meta_description', form.meta_description[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>             
          </div>
          <div class="flex w-full lg:w-1/2" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'pr-6'" :key="'header-' + lang"> 
            <text-input v-model="form.header[lang]" :errors="error_msg['header.'+lang]" class="pb-8 pr-6 w-full " v-bind:class="(defaultlocale == lang) ? '' :'lg:w-8/9'" label="Заголовок (H1)" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-6 mt-6 lg:ml-0 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'header', form.header[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>                        
          </template>
          <select-input v-model="form.festival_id" class="pr-6 pb-8 w-full lg:w-1/2" :errors="error_msg['festival_id']" label="Фестивали">
            <option v-for="festival in fests" :key="festival.id" :value="festival.id" >{{ JSON.parse(festival.name)[defaultlocale] }}
            </option>
          </select-input> 
          <div class="flex w-full pb-6">
            <div class="flex w-1/6 mr-2 justify-center items-center">
              <img :src="form.image ? form.image : noImage" v-bind:class="form.image ? 'h-16 object-contain bg-gray-400' : 'h-22 object-contain'" >
            </div>
            <div class="flex flex-col w-4/7 mr-4">
              <div class="pr-2 text-md">Изображение:</div>
              <div class="pt-2 text-sm w-5/7 break-all mx-4">{{form.image ? form.image : 'Ничего не выбрано'}}</div>
              <div v-if="error_msg['image']" class="form-error">{{ error_msg['image'][0] }}</div>  
              <button title="Удалить" v-bind:class="form.image ? 'pt-2 px-4 w-0' : 'invisible'"
              @click.prevent ="form.image=''">
                  <icon name="trash" class="block w-4 h-4 fill-red-600" />
              </button>
            </div>
            <button title="Выбрать Изображение" class="inline-flex bg-red-600 text-white w-14 h-10 rounded mt-6 cursor-pointer w-auto ml-5 pr-2 items-center" v-on:click.stop.prevent="open = true">
              <svg class="fill-current text-white w-6 h-6 ml-2 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11 9l-3-3-6 6h16l-5-5-2 2zm4-4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
              ...
            </button>
          </div>
        <template v-for="lang of langs" >
          <template v-for="(disposition_place, index) of form.disposition_places" >  
            <div class="flex w-full lg:w-1/2" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'pr-6'" :key="'place-' + lang + '-' + index"> 
              <button title="Удалить" class="pt-2 pr-4 w-0"
              @click.prevent ="deleteItem(index)">
                  <icon name="trash" class="block w-6 h-6 fill-red-600" />
              </button>  
              <text-input v-model="disposition_place.place[lang]" :errors="error_msg['place.'+lang]" class="pl-4 pb-8 pr-6 w-full" v-bind:class="(defaultlocale == lang) ? '' :'lg:w-8/9'" label="Место" />
              <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-6 mt-6 lg:ml-0 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translateJson(defaultlocale, lang, 'form', 'disposition_places', index, 'place', disposition_place.place[defaultlocale])">
              <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
              </button>
            </div>
            <div class="flex w-full pr-6 lg:w-1/2" v-show="lang == current_locale" :key="'members-' + lang + '-' + index"> 
              <text-input v-model="disposition_place.member[lang]" :errors="error_msg['member.'+lang]" class="pb-8 pr-6 w-full" v-bind:class="(defaultlocale == lang) ? '' :'lg:w-7/8'" label="Участник"/>
              <button v-show="lang == defaultlocale" class="bg-teal-400 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Поиск" v-on:click.stop.prevent="showMembersSearch=true; memberIndex=index">
                <svg version="1.1" class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                  viewBox="0 0 52.966 52.966" style="enable-background:new 0 0 52.966 52.966;" xml:space="preserve">
                  <path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
                    c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
                    C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
                    S32.459,40,21.983,40z"/>
                </svg>                
              </button>
              <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translateJson(defaultlocale, lang, 'form', 'disposition_places', index, 'member', disposition_place.member[defaultlocale])">
              <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
              </button>
              <button title="Добавить" class="pt-2 px-2 w-0"
              @click.prevent ="addItem(index)">
                  <icon name="add" class="block w-6 h-6 fill-green-600" />
              </button>                            
            </div>    
          </template>                      
        </template>            
        </div>
        <div class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center">
          <loading-button :loading="sending" class="btn-indigo text-white hover:bg-red-600 focus:bg-red-600" type="submit">Сохранить</loading-button>
        </div>
      </form>
    </div>
    <modal :showing="open" @close="open = false; showDropzone = false">
      <div>
        <h1 class="text-xl font-bold text-gray-900">Выберите изображение</h1>
        <nav class="text-black font-bold my-8" aria-label="Breadcrumb">
        <ol class="list-none p-0 inline-flex">
          <li class="flex items-center">
          <icon name="home" class="flex-shrink-0 w-6 h-6 cursor-pointer" @click.native="deleteFromPatch(-1)"/>                
          <icon name="cheveron-right" class="flex-shrink-0 w-5 h-5 cursor-pointer" @click="deleteFromPatch(-1)"/>                
          </li>
          <li class="flex items-center" v-for="(breadcrum, index) in fullPatch">
            <span v-if="index !== fullPatch.length - 1" @click="deleteFromPatch(index)" class="cursor-pointer">{{breadcrum}}</span>
            <span v-else class="text-gray-500 aria-current:page cursor-default">{{breadcrum}}</span>
            <svg v-if="index !== fullPatch.length - 1" class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
          </li>
        </ol>
        </nav>
        <!-- show showDropzone -->
        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions" :useCustomSlot=true v-on:vdropzone-sending="sendingEvent" @vdropzone-success="vsuccess" v-show="showDropzone">
          <dropzone class="h-8 text-grey mr-2 z-49"> </dropzone>
            <span class="block text-grey">Перетащите, чтобы загрузить контент! <br> ... или нажмите, чтобы выбрать файл</span>              
        </vue-dropzone>
        <div class="flex text-center flex-wrap pb-10" >
          <folder v-for="folder in folders" :key="folder.name" :name="folder.name"  @click.native="addToPatch(folder.name)"></folder>
          <file v-for="file in files" :key="file.name" :name="file.name" :source="file.path" @click.native="selectFile(file.path)"></file>
        </div>                        
        <div class="mt-6 mb-6 flex flex-wrap">
          <template v-for="(link, key) in links">
            <div v-if="link.url === null" :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400" :class="{ 'ml-auto': link.label === 'Вперед' }">{{ link.label }}</div>
            <span v-else :key="key" class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500" :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Вперед' }" @click="onPage(link.label)">{{ link.label }}</span>
          </template>
        </div>
      </div>
      <div class="flex justify-end">
        <button
          class="justify-end bg-indigo-600 text-white h-10 px-4 py-2 text-sm tracking-wide font-bold rounded"
          @click="open = false; showDropzone = false ">
          Закрыть
        </button>
        <button class="inline-flex justify-end bg-indigo-600 text-white h-10 ml-5 px-4 py-2 text-sm tracking-wide font-bold rounded"
        @click="showDropzone = !showDropzone">
        <dropzone class="fill-white w-4 h-4 mr-2"> </dropzone>
          <span class="block">Загрузить</span>
        </button>
      </div>           
    </modal>
    <modal :showing="showMembersSearch" @close="showMembersSearch = false;">
      <div>
        <h2 class="text-base lg:text-xl mb-8 font-bold text-gray-900">Выберите участника </h2>
      </div>
            <div class="pb-8 lg:pb-16 w-full"> 
            <autocomplete
              input-class="form-control h-10"
              name="search"
              :showNoResults="false"
              placeholder="Поиск участника"
              @selected="selectedMember"
              source='/admin/getmembers?search='
              :results-display="formattedMembers"
              results-property="members"
              > 
            </autocomplete>  
            </div>        
      <div class="flex justify-end">
        <button
          class="justify-end bg-indigo-600 text-white h-10 px-4 py-2 text-sm tracking-wide font-bold rounded"
          @click="showMembersSearch = false">
          Закрыть
        </button>
      </div>           
    </modal>     
  </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import LoadingButton from '@/Shared/LoadingButton'
import TextInput from '@/Shared/TextInput'
import Editor from '@tinymce/tinymce-vue'
import Icon from '@/Shared/Icon'
import Modal from '@/Shared/Modal'
import Dropzone from '@/Shared/Dropzone'
import Folder from '@/Shared/Folder'
import File from '@/Shared/File'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import TextareaInput from '@/Shared/TextareaInput'
import SelectInput from '@/Shared/SelectInput'
import Autocomplete from 'vuejs-auto-complete'

export default {
  metaInfo: { title: 'Редактировать схему размещения' },
  layout: Layout,
  components: {
    LoadingButton,
    TextInput,
    Editor,
    Icon,
    Modal,
    Dropzone,
    Folder,
    File,
    vueDropzone: vue2Dropzone,
    TextareaInput,
    SelectInput,
    Autocomplete    
  },
  props: {
    disposition: Object,
    festivals: Array,     
  },  
  remember: 'form',
  data() {
    return {
      current_locale:'',
      sending: false,
      form: {
        header: JSON.parse(this.disposition.header),
        meta_title: JSON.parse(this.disposition.meta_title),
        meta_description: JSON.parse(this.disposition.meta_description),
        image: this.disposition.image,
        festival_id: this.disposition.festival_id,
        disposition_places: [],
      },
      fests: this.festivals,
      showMembersSearch: false,
      memberIndex: 0,
      error_msg:{},
      noImage: '/storage/no-image-100.png',
      folders: Array,
      files: Array,
      items: Object,
      links: [],
      linkItems: {},     
      fullPatch: [],
      currentPage: 0,
      open: false,
      showDropzone: false,
      dropzoneOptions: {
          url: '/admin/upload',
          thumbnailWidth: 150,
          maxFilesize: 15,
          addRemoveLinks: true,
          acceptedFiles: ".jpeg,.jpg,.png,.gif,.ico",
          headers: {
            'X-CSRF-TOKEN': token_csrf
          },
          paramName: 'sFilename',
       
          /* dictDefaultMessage: "<dropzone class='fill-white w-4 h-4 mr-2'> </dropzone>UPLOAD ME"  */         
        
      }      
    }
  },
  computed: {
    disabledUp(){
      if (this.fullPatch.length == 0) {
          return false;
      }
      return true;
    }
  },  
  created() {
    this.current_locale = this.defaultlocale;

    if (this.disposition.disposition_places.length == 0) {

      this.form.disposition_places.push({place:{}, member:{}});
      this.langs.forEach((item, i, langs)=> {

        Vue.set( this.form.disposition_places[0].place,item, '');
        Vue.set( this.form.disposition_places[0].member,item, '');      

      }) 
    } else {
 
        this.disposition.disposition_places.forEach((item, i)=> {
        var object = {};         
        Vue.set( object,'place', JSON.parse(item.place));
        Vue.set( object,'member', JSON.parse(item.member));   
        this.form.disposition_places = Object.assign({}, this.form.disposition_places, {
          [i]: object,
        }) 
      }); 

    }
 



    this.loadFiles();
   
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
    addItem(index){

      var object = {
        place: {}, 
        member: {}
        };

      this.langs.forEach((item, i, langs)=> {
        Vue.set( object.place,item, '');
        Vue.set( object.member,item, '');
      });

      if (this.form.disposition_places[index].place[this.defaultlocale].length>0 || this.form.disposition_places[index].member[this.defaultlocale].length>0 ) {
  
        this.form.disposition_places = Object.assign({}, this.form.disposition_places, {
          [++index]: object,
        })      
      }
    },

    deleteItem(index){

    var count = Object.keys(this.form.disposition_places).length;
    
    if(count>1) {

      Vue.delete(this.form.disposition_places, index);

    }

    },
     
    selectedMember(member){
      this.form.disposition_places[this.memberIndex].member=JSON.parse(member.selectedObject.name);
    },

    formattedMembers (result) {
    var name = JSON.parse(result.name);
    return name[this.defaultlocale];
    },  

    submit() {
      this.sending = true
      this.$inertia.put(this.route('dispositions.update', this.disposition.id), this.form)
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
      });      
    },

    translateJson(defaultLang, currentLang, prefix, group, index, input, textForTranslate) {
      this.fields.textTranslate = textForTranslate;
      this.fields.defaultLang = defaultLang;
      this.fields.currentLang = currentLang;
      this.axios.post(this.route('translate.index'), this.fields).then(response => {
        this[prefix][group][index][input][currentLang] = response.data;
      });      
    },

    selectFile(fName) {
      this.form.image = fName;
      
      this.open = false; 
      this.showDropzone = false 
    },
    onPage(numberPage){
      var nPage =0;
      if(numberPage== "Назад") {
        nPage = (this.currentPage-1);
      } else if (numberPage== "Вперед"){
        nPage = (this.currentPage+1);
      } else {
        nPage = numberPage; 
      }
  
      this.axios.get(this.route('filemanager.index', {directory: this.fullPatch.join('/'), page: nPage})).then(response => {
        this.items= response.data.items;
        this.items.data = Object.values(this.items.data);
      
        var aFolders = [];
        var aFiles = [];
        
        this.items.data.forEach(function(item) {
          if (item.type === 'folder') {
            aFolders.push(item);
          } else {
            aFiles.push(item);
          }
        });
        this.folders = aFolders;
        this.files = aFiles;        
        this.links = [];
        var total = this.items.total;
        var perPage = this.items.per_page;
        var path = this.items.path;
        
        var adPath = (this.fullPatch.join('/')=='') ? '?page=' : '?directory=' + this.fullPatch.join('/') +'&page=';
        
        var pages = Math.ceil(total/perPage);
        this.currentPage = this.items.current_page;
        
        var prevPageUrl = this.items.prev_page_url;
        var nextPageUrl = this.items.next_page_url;
        var lastPage = this.items.last_page;

        if(pages>1){
          this.linkItems.url = (this.currentPage>1) ? (prevPageUrl) :null;
          this.linkItems.label = 'Назад';
          this.linkItems.active = false;
          this.links.push(this.linkItems);
          this.linkItems={};
          for (var i = 0; i < pages; i++) {
            this.linkItems={};
            this.linkItems.url = (path + adPath+(i+1));
            this.linkItems.label = (i+1);
            this.linkItems.active = (this.currentPage==(i+1));
            this.links.push(this.linkItems);
          }
          this.linkItems={};
          this.linkItems.url = (this.currentPage<lastPage) ? (nextPageUrl) : null;
          this.linkItems.label = 'Вперед';
          this.linkItems.active = false;
          
          this.links.push(this.linkItems);          
        }
      });       
    },    
    deleteFromPatch(index){
      if (this.disabledUp) {
        while(index<this.fullPatch.length-1){
          this.fullPatch.pop();
        }
      } 
      this.loadFiles();           
    },
    addToPatch(fname){
      this.fullPatch.push(fname);
      this.loadFiles();
    },    
    sendingEvent (file, xhr, formData) {
      //тут типа проверить и добавить имя папки
      var directory = '';
      directory = this.fullPatch.join('/');
      formData.append('directory', directory);
      },
    vsuccess(file, success)      {
      this.loadFiles();

    },    
    loadFiles(){
      this.axios.get(this.route('filemanager.index',{directory: this.fullPatch.join('/')})).then(response => {
        this.items= response.data.items;
        var aFolders = [];
        var aFiles = [];

        this.items.data.forEach(function(item) {
          if (item.type === 'folder') {
            aFolders.push(item);
          } else {
            aFiles.push(item);
          }
        });
        this.folders = aFolders;
        this.files = aFiles;
        this.links = [];
        var total = this.items.total;
        var perPage = this.items.per_page;
        var path = this.items.path;
        var adPath = (this.fullPatch.join('/')=='') ? '?page=' : '?directory=' + this.fullPatch.join('/') +'&page=';
        var pages = Math.ceil(total/perPage);
        this.currentPage = this.items.current_page;
        var prevPageUrl = this.items.prev_page_url;
        var nextPageUrl = this.items.next_page_url;
        var lastPage = this.items.last_page;

        if(pages>1){
          this.linkItems.url = (this.currentPage>1) ? prevPageUrl :null;
          this.linkItems.label = 'Назад';
          this.linkItems.active = false;
          this.links.push(this.linkItems);
          this.linkItems={};
          for (var i = 0; i < pages; i++) {
            this.linkItems={};
            this.linkItems.url = (path + adPath+(i+1));
            this.linkItems.label = (i+1);
            this.linkItems.active = (this.currentPage==(i+1));
            this.links.push(this.linkItems);
          }
          this.linkItems={};
          this.linkItems.url = (this.currentPage<lastPage) ? nextPageUrl : null;
          this.linkItems.label = 'Вперед';
          this.linkItems.active = false;
          this.links.push(this.linkItems);          
        }
      });       
    },
                
  },
}
</script>
<style scope>
.tox .tox-editor-header {
    z-index: 0 !important;
}

</style>