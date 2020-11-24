<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('proposals')">Заявка на участие</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.member[defaultlocale] }}
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <div class="bg-white border-none w-full px-8 ml-1 text-md flex justify-end items-center" >
        <button class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300" v-bind:class="(current_locale == lang) ? 'bg-red-600' :'bg-indigo-600'" v-for="lang of langs" :value="lang" v-on:click="changeLang($event)" :key="lang">{{lang}}</button>
      </div>   
  
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <template v-for="lang of langs" >
          <div class="flex w-full pr-6 lg:w-1/2" v-show="lang == current_locale" :key="'member-'+lang">
            <text-input v-model="form.member[lang]" :errors="error_msg['member.'+lang]" class="pb-8 pr-6 lg:w-8/9" label="ФИО" />
            <button v-show="lang == defaultlocale" class="bg-teal-400 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Поиск" v-on:click.stop.prevent="showMembersSearch=true">
              <svg version="1.1" class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 52.966 52.966" style="enable-background:new 0 0 52.966 52.966;" xml:space="preserve">
                <path d="M51.704,51.273L36.845,35.82c3.79-3.801,6.138-9.041,6.138-14.82c0-11.58-9.42-21-21-21s-21,9.42-21,21s9.42,21,21,21
                  c5.083,0,9.748-1.817,13.384-4.832l14.895,15.491c0.196,0.205,0.458,0.307,0.721,0.307c0.25,0,0.499-0.093,0.693-0.279
                  C52.074,52.304,52.086,51.671,51.704,51.273z M21.983,40c-10.477,0-19-8.523-19-19s8.523-19,19-19s19,8.523,19,19
                  S32.459,40,21.983,40z"/>
              </svg>                
            </button>            
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'member', form.member[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>
          <div class="flex w-full lg:w-1/2" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'pr-6'" :key="'studio-'+lang"> 
            <text-input v-model="form.studio[lang]" :errors="error_msg['studio.'+lang]" class="pb-8 pr-6 w-full" v-bind:class="(defaultlocale == lang) ? '' :'lg:w-8/9'" label="Студия" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'studio', form.studio[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>
          </template>

          <select-input v-model="form.festival_id" :errors="$page.errors.festival_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Фестиваль">
            <option v-for="festival in festivals" :key="festival.id" :value="festival.id">{{ JSON.parse(festival.name)[defaultlocale] }}</option>
          </select-input>
          <select-input v-model="form.specialization_id" :errors="$page.errors.specialization_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Специализация">
            <option v-for="specialization in specializations" :key="specialization.id" :value="specialization.id">{{ JSON.parse(specialization.name)[defaultlocale] }}</option>
          </select-input> 
          <text-input v-model="form.social.facebook" :errors="$page.errors.social" class="pr-6 pb-8 w-full lg:w-1/2" label="Facebook" />
          <text-input v-model="form.social.instagram" :errors="$page.errors.social" class="pr-6 pb-8 w-full lg:w-1/2" label="Instagram" />
          <text-input v-model="form.social.email" :errors="$page.errors.social" class="pr-6 pb-8 w-full lg:w-1/2" label="E-mail" />
          <text-input v-model="form.social.website" :errors="$page.errors.social" class="pr-6 pb-8 w-full lg:w-1/2" label="Website"/>
          <select-input v-model="form.country_id" :errors="$page.errors.country_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Страна">
            <option v-for="country in countries" :key="country.id" :value="country.id">{{ JSON.parse(country.name)[defaultlocale] }}</option>
          </select-input>
          <div class="flex w-full lg:w-1/2" v-for="lang of langs" v-show="lang == current_locale" :key="'city-'+lang"> 
            <text-input v-model="form.city[lang]" :errors="error_msg['city.'+lang]" class="pb-8" v-bind:class="(defaultlocale == lang) ? 'pr-6 w-full' :'w-6/7 lg:w-5/6 lg:pr-6'" label="Город" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'city', form.city[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>
          <text-input v-model="form.phone" :errors="$page.errors.phone" class="pr-6 pb-8 w-full lg:w-1/2" label="Телефон" v-mask="'+38(###) ####-###'"  placeholder="+38(067) 1234-567" />
         <!--  <text-input v-model="form.count_worker" :errors="$page.errors.count_worker" :type="'number'" class="pr-6 pb-8 w-full lg:w-1/2" label="Количество сотрудников"/>  -->
          <select-input v-model="form.status_id" :errors="$page.errors.status_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Статус заявки">
            <option v-for="status in statuses" :key="status.id" :value="status.id">{{status.name}}</option>
          </select-input>  
          <text-input v-model="form.place_number" :errors="$page.errors.place_number" class="pr-6 pb-8 w-full lg:w-1/2" label="Номер места"/> 
          <select-input v-model="form.place_format_id" :errors="$page.errors.place_format_id" class="pr-6 pb-8 w-full lg:w-1/2" label="Формат места">
            <option v-for="placeformat in placeformats" :key="placeformat.id" :value="placeformat.id">{{ JSON.parse(placeformat.name)[defaultlocale] }}</option>
          </select-input>
          <!-- <div class="flex w-full pb-6 lg:w-1/2 lg:pr-6" > -->
          <div class="flex w-full pb-6" >
            <div class="flex w-1/6 mr-2 justify-center items-center">
              <img :src="form.logo ? form.logo : noImage" v-bind:class="form.logo ? 'h-16 object-contain bg-gray-400' : 'h-22 object-contain'" >
            </div>
            <div class="flex flex-col w-4/7 mr-2">
              <div class="pr-2 text-md">Фото профиля:</div>
              <div class="pt-2 text-sm w-5/7 break-all mx-2">{{form.logo ? form.logo : 'Ничего не выбрано'}}</div>
              <button title="Удалить" v-bind:class="form.logo ? 'pt-2 px-4 w-0' : 'invisible'"
              @click.prevent ="form.logo=''">
                  <icon name="trash" class="block w-4 h-4 fill-red-600" />
              </button>
            </div>
            <button title="Выбрать фото" class="inline-flex bg-red-600 text-white w-14 h-10 rounded mt-6 cursor-pointer w-auto ml-5 pr-2 items-center" v-on:click.stop.prevent="open = true; imageField='logo'">
              <svg class="fill-current text-white w-6 h-6 ml-2 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11 9l-3-3-6 6h16l-5-5-2 2zm4-4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
              ...
            </button>
          </div>          
                                        
<!--       `portfolio`,    -->   
          <div class="flex flex-col w-full pb-6">
            <template v-for="(item, index) in form.portfolio">
            <div class="flex inline-flex w-full pb-8" :key="index">
            <div class="flex w-1/6 mr-2 justify-center items-center">
              <img :src="item[index] != null ? item : noImage" v-bind:class="item[index] != null ? 'h-16 object-contain bg-gray-400' : 'h-22 object-contain'" >
            </div>
            <div class="flex flex-col w-4/7 mr-4">
              <div class="pr-2 text-md">Портфолио:</div>

              <div class="pt-2 text-sm w-5/7 break-all mx-4">{{item[index] != null ? item : 'Ничего не выбрано'}}</div>
              <button title="Удалить" v-bind:class="item[index] != null ? 'pt-2 px-4 w-0' : 'invisible'"
              @click.prevent ="deleteItem(index)">
                  <icon name="trash" class="block w-4 h-4 fill-red-600" />
              </button>

            </div>

            <button title="Добавить портфолио" class="inline-flex bg-red-600 text-white w-14 h-10 rounded mt-6 cursor-pointer w-auto ml-5 pr-2 items-center" v-on:click.prevent="addPortfolio(index)">
              <svg class="fill-current text-white w-6 h-6 ml-2 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11 9l-3-3-6 6h16l-5-5-2 2zm4-4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
              ...
            </button>
            <button title="Добавить" class="pt-2 px-4 w-0"
            @click.prevent ="addItem(index)">
                <icon name="add" class="block w-6 h-6 fill-green-600" />
            </button>   
            </div>          
            </template>
          </div> 
          <div class="flex w-full mr-6">  
          <textarea-input v-model="form.comment" class="pb-8 w-full" label="Комментарий"/>
          </div>           
                                             
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
          <icon name="home" class="flex-shrink-0 w-6 h-6" @click.native="deleteFromPatch(-1)"/>                
          <icon name="cheveron-right" class="flex-shrink-0 w-5 h-5" @click="deleteFromPatch(-1)"/>                
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
          <file v-for="file in files" :key="file.name" :name="file.name" :source="file.path" @click.native="selectFile(file.path, imageFieldIndex)"></file>
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
        <button class="inline-flex justify-end bg-indigo-600 text-white h-10 ml-5 px-4 py-2 text-sm tracking-wide font-bold rounded items-center"
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
import Icon from '@/Shared/Icon'
import SelectInput from '@/Shared/SelectInput'
import TextareaInput from '@/Shared/TextareaInput'
import Modal from '@/Shared/Modal'
import Dropzone from '@/Shared/Dropzone'
import Folder from '@/Shared/Folder'
import File from '@/Shared/File'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import Autocomplete from 'vuejs-auto-complete'
/* import {mask} from 'vue-the-mask'  */
/* import VueMask from 'v-mask' */
export default {
  metaInfo: { title: 'Редактировать заявку на участие' },
  layout: Layout,
  components: {
    LoadingButton,
    TextInput,
    Icon,
    SelectInput,
    TextareaInput,
    Modal,
    Dropzone,
    Folder,
    File,
    vueDropzone: vue2Dropzone,
    Autocomplete,

  },
/*   directives: { VueMaskDirective},   */
  props: {
    proposal: Object,
    festivals: Array,  
    countries: Array,  
    members: Array,  
    specializations: Array,
    placeformats: Array,
    language_id: Number,  
  },
  remember: {
    data: ['form'],
  },
  data() {
    return {
      current_locale:'',
      sending: false,
      form: {
        festival_id: this.proposal.festival_id,
        language_id: this.proposal.language_id,
        country_id: this.proposal.country_id,
        member: JSON.parse(this.proposal.member),
        specialization_id: this.proposal.specialization_id,
        studio: JSON.parse(this.proposal.studio),
        city: JSON.parse(this.proposal.city),
        social: JSON.parse(this.proposal.social),
        place_format_id: this.proposal.place_format_id,
        place_number: this.proposal.place_number,
        phone: this.proposal.phone,
        logo: this.proposal.logo,
        portfolio: JSON.parse(this.proposal.portfolio),
       // count_worker: (this.proposal.count_worker).toString(),
        comment: this.proposal.comment,
        status_id: this.proposal.status_id,
      },
      statuses: [],
      showMembersSearch: false,
      imageField: '',
      imageFieldIndex: '',
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
/*           headers: {
            'X-CSRF-TOKEN': token_csrf
          }, */
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
    this.statuses[0] = {
      id: 1,
      name: 'Новая'
    };
    this.statuses[1] = {
      id: 2,
      name: 'Ожидаем оплату'
    };
    this.statuses[2] = {
      id: 3,
      name: 'Оплачена'
    };
    this.statuses[3] = {
      id: 4,
      name: 'Отменена'
    };

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
    selectedMember(member){
      this.form.member=JSON.parse(member.selectedObject.name);
    },
    formattedMembers (result) {
    var name = JSON.parse(result.name);
    return name[this.defaultlocale];
    },    
    addPortfolio (index){
      this.imageFieldIndex= index; 
      this.imageField='portfolio'; 
      this.open = true; 
    },
    addItem(){
      var k, v = 0;
      for (let [key, value] of Object.entries(this.form.portfolio)) {
        k = key;
        v = value;   
      }
      if (v.length>0) {
      this.form.portfolio = Object.assign({}, this.form.portfolio, {
        [++k]: '',
      })      
      }

    },
    deleteItem(index){
      var lengthKey = (this.form.portfolio.length || Object.keys(this.form.portfolio).length);
      //console.log('lengthKey='+lengthKey, 'index='+index);
      if (lengthKey>1){
      Vue.delete(this.form.portfolio, index)  
      //this.form.portfolio.delete(index);
      } else {
       // this.form.portfolio[index]= '';
        Vue.set( this.form.portfolio, index, '' )
      }
    },
    selectFile(fName, fIndex="") {
      if (fIndex !=="") {
        this.form[this.imageField][this.imageFieldIndex] = fName;
        this.imageFieldIndex ='';
      } else {
        this.form[this.imageField] = fName;  
      }
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
        console.log('path_page = '+this.fullPatch.join('/'));
        var adPath = (this.fullPatch.join('/')=='') ? '?page=' : '?directory=' + this.fullPatch.join('/') +'&page=';
        
        var pages = Math.ceil(total/perPage);
        this.currentPage = this.items.current_page;
        //console.log('currentPage= ' +this.currentPage);
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
         // console.log(this.linkItems.url+ ' _NEXT');
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
      console.log('upload finishe')
    },
    loadFiles(){
      this.axios.get(this.route('filemanager.index',{directory: this.fullPatch.join('/')})).then(response => {
        this.items= response.data.items;
        var aFolders = [];
        var aFiles = [];
        //console.log(this.items.data);
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
    submit() {
      this.sending = true
      this.$inertia.put(this.route('proposals.update', this.proposal.id), this.form)
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