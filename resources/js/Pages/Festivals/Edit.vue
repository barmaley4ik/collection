<template>
  <div>
    <h1 class="mb-8 font-bold text-3xl">
      <inertia-link class="text-indigo-400 hover:text-indigo-600" :href="route('festivals')">Фестивали</inertia-link>
      <span class="text-indigo-400 font-medium">/</span>
      {{ form.name_ru }}
    </h1>
    <div class="bg-white rounded shadow overflow-hidden max-w-3xl">
      <div class="bg-white border-none w-full px-8 ml-1 text-md flex justify-end items-center" >
        <button class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300" v-bind:class="(current_locale == lang) ? 'bg-red-600' :'bg-indigo-600'" v-for="lang of langs" :value="lang" v-on:click="changeLang($event)" :key="lang">{{lang}}</button>
      </div>          
      <form @submit.prevent="submit">
        <div class="p-8 -mr-6 -mb-8 flex flex-wrap">
          <template v-for="lang of langs" >
          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key=" 'name' + lang "> 
            <text-input v-model="form.name[lang]" :errors="error_msg['name.'+lang]" class="pb-8 pr-6 w-full" label="Наименование" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'name', form.name[defaultlocale], $event)">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>

           <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'meta_title-' + lang"> 
            <text-input v-model="form.meta_title[lang]" :errors="error_msg['meta_title.'+lang]" class="pb-8 pr-6 w-full" label="Title" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'meta_title', form.meta_title[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>
          </div>

          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'meta_description-' + lang">  
          <textarea-input v-model="form.meta_description[lang]" :errors="$page.errors.meta_description" class="pr-6 pb-8 w-full" label="Description" :key="'meta_description-' + lang"/>
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'meta_description', form.meta_description[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>             
          </div>           

          <div class="flex w-full flex-col pb-8 mr-6" v-show="lang == current_locale" :key="'custom_text-' + lang"> 
            <label class="form-label">Произвольный текст:</label>
              <div class="w-full"  v-bind:class="(defaultlocale == lang) ? '' :'flex'">
                <editor :name="'custom_text[' + lang + ']'" v-model="form.custom_text[lang]" :init="{plugins: 'autolink lists hr anchor searchreplace visualblocks code insertdatetime paste', language: 'ru', skin: 'oxide', branding: false, menubar: 'format', toolbar: 'styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | code | table'  }" />

                <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-10 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'custom_text', form.custom_text[defaultlocale])">

                <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
                </button>
            </div> 
          </div> 

          <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key=" 'adress' + lang ">   
            <textarea-input v-model="form.adress[lang]" :errors="error_msg['adress.'+lang]" class="pb-8 pr-6 w-full" label="Адрес"  />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'adress', form.adress[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>            
          </div>  

           <div class="flex w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key=" 'city' + lang ">   
            <text-input v-model="form.city[lang]" :errors="error_msg['city.'+lang]" class="pb-8 pr-6 w-full" label="Город"  @input="changeSlug(lang)" />
            <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-6 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'city', form.city[defaultlocale])">
            <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
            </button>            
          </div>

          </template>

          <text-input v-model="form.slug" :errors="$page.errors.slug" class="pr-6 pb-8 w-full lg:w-1/2" label="URL страницы" />
          <text-input v-model="form.google_map_coordinates" :errors="$page.errors.google_map_coordinates" class="pr-6 pb-8 w-full lg:w-1/2" label="Ссылка для карты" />
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <label class="form-label" :for="'date-start'">Дата начала:</label>
            <date-pick
                v-model="form.date_start"
                :displayFormat="'DD.MM.YYYY'"
                :format= "'YYYY-MM-DD'"
                :inputAttributes="{readonly: true, required: true, id: 'date-start'}"
                :nextMonthCaption= "nextMonthCaption"
                :prevMonthCaption= "prevMonthCaption"
                :setTimeCaption= "setTimeCaption"
                :weekdays= "weekdays"
                :months= "months"
                :class="error_msg.date_start ? 'error form-input' :'form-input' "

            ></date-pick>
            <div v-if="error_msg.date_start" class="form-error">{{ error_msg.date_start[0] }}</div>
          </div>
          <div class="pr-6 pb-8 w-full lg:w-1/2">
            <label class="form-label" :for="'date-end'">Дата окончания:</label>
            <date-pick
                v-model="form.date_end"
                :displayFormat="'DD.MM.YYYY'"
                :format= "'YYYY-MM-DD'"
                :inputAttributes="{readonly: true, required: true, id: 'date-end' }"
                :nextMonthCaption= "nextMonthCaption"
                :prevMonthCaption= "prevMonthCaption"
                :setTimeCaption= "setTimeCaption"
                :weekdays= "weekdays"
                :months= "months"
                :class="error_msg.date_end ? 'error form-input' :'form-input' "

            ></date-pick>
            <div v-if="error_msg.date_end" class="form-error">{{ error_msg.date_end[0] }}</div>
          </div>            
    
          <text-input v-model="form.video_url" :errors="$page.errors.video_url" class="pr-6 pb-8 w-full lg:w-1/2" label="Видео" />
          <text-input v-model="form.concert_ua_url" :errors="$page.errors.concert_ua_url" class="pr-6 pb-8 w-full lg:w-1/2" label="Ссылка на билет" />
          <div class="pr-6 pb-8 w-full lg:w-1/2 items-center mb-6">
            <label class="form-label">
              По-умолчанию:
            </label>
            <input v-model="form.is_default" class="pl-6 w-6 h-6 mr-2 form-checkbox focus:border-red-500 focus:bg-red-500 focus:text-red-500 text-red-500" type="checkbox">
          </div>
          <div class="pr-6 pb-8 w-full lg:w-1/2 items-center mb-6">
            <label class="form-label">
              Статус:
            </label>
            <input v-model="form.status" class="pl-6 w-6 h-6 mr-2 form-checkbox focus:border-red-500 focus:bg-red-500 focus:text-red-500 text-red-500" type="checkbox">
          </div>                    
          
          <div class="flex flex-col w-full pb-6">
            <template v-for="(item, index) in form.gallery">
            <div class="flex inline-flex w-full pb-8" :key="index">
            <div class="flex w-1/6 mr-2 justify-center items-center">
              <img :src="item ? item : noImage" v-bind:class="item ? 'h-16 object-contain bg-gray-400' : 'h-22 object-contain'" >
            </div>
            <div class="flex flex-col w-4/7 mr-4">
              <div class="pr-2 text-md">Галерея:</div>

              <div class="pt-2 text-sm w-5/7 break-all mx-4">{{item  ? item : 'Ничего не выбрано'}}</div>
              <button title="Удалить" v-bind:class="item ? 'pt-2 px-4 w-0' : 'invisible'"
              @click.prevent ="deleteItem(index)">
                  <icon name="trash" class="block w-4 h-4 fill-red-600" />
              </button>
            </div>
            <button title="Добавить галерею" class="inline-flex bg-red-600 text-white w-14 h-10 rounded mt-6 cursor-pointer w-auto ml-5 pr-2 items-center" v-on:click.prevent="addPortfolio(index)">
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
          <template v-for="(item, index) in form.phones" > 
          <text-input v-model="form.phones[index]" :errors="$page.errors.phones" class="pr-6 pb-8 w-full lg:w-1/2" :label="`Телефон`+ (Number([index])+1)" v-mask="'+38(###) ####-###'" placeholder="+38(067) 1234-567" :key="'phone-' + index"/> 
          </template>
          <div class="shadow-md flex flex-wrap w-full mb-6 mr-6"> 
            <template v-for="lang of langs" >
            <div class="flex ml-4 w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'supervisor_project-' + lang"> 
              <text-input v-model="form.supervisor_project.name[lang]" class="pt-4 pb-8 pr-8 w-full" label="Руководитель проекта" />
              <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-10 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'supervisor_project', form.supervisor_project.name[defaultlocale])">
              <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
              </button>
            </div>
            </template>
            <div class="flex ml-4 w-full pb-6">
              <div class="flex w-1/6 mr-2 justify-center items-center">
                <img :src="form.supervisor_project.photo ? form.supervisor_project.photo : noImage" v-bind:class="form.supervisor_project.photo ? 'h-16 object-contain bg-gray-400' : 'h-22 object-contain'" >
              </div>
              <div class="flex flex-col w-4/7 mr-4">
                <div class="pr-2 text-md">Фото профиля:</div>
                <div class="pt-2 text-sm w-5/7 break-all mx-4">{{form.supervisor_project.photo ? form.supervisor_project.photo : 'Ничего не выбрано'}}</div>
                <button title="Удалить" v-bind:class="form.supervisor_project.photo ? 'pt-2 px-4 w-0' : 'invisible'"
                @click.prevent ="form.supervisor_project.photo=''">
                    <icon name="trash" class="block w-4 h-4 fill-red-600" />
                </button>
              </div>
              <button title="Выбрать Фото" class="inline-flex bg-red-600 text-white w-14 h-10 rounded mt-6 cursor-pointer w-auto ml-8 pr-2 items-center" v-on:click.stop.prevent="open = true; imageField='supervisor_project'">
                <svg class="fill-current text-white w-6 h-6 ml-2 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11 9l-3-3-6 6h16l-5-5-2 2zm4-4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                ...
              </button>
            </div>            
          </div>
          <div class="shadow flex flex-wrap w-full mb-6 mr-6"> 
            <template v-for="lang of langs" >
            <div class="flex ml-4 w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'supervisor_sponsors-' + lang"> 
              <text-input v-model="form.supervisor_sponsors.name[lang]" class="pt-4 pb-8 pr-8 w-full" label="Работа со спонсорами" />
              <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-10 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'supervisor_sponsors', form.supervisor_sponsors.name[defaultlocale])">
              <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
              </button>
            </div>
            </template>
            <text-input v-model="form.supervisor_sponsors.email" type="email" class="ml-4 pr-8 pb-8 w-full" label="E-mail" />
            <div class="flex ml-4 w-full pb-6">
              <div class="flex w-1/6 mr-2 justify-center items-center">
                <img :src="form.supervisor_sponsors.photo ? form.supervisor_sponsors.photo : noImage" v-bind:class="form.supervisor_sponsors.photo ? 'h-16 object-contain bg-gray-400' : 'h-22 object-contain'" >
              </div>
              <div class="flex flex-col w-4/7 mr-4">
                <div class="pr-2 text-md">Фото профиля:</div>
                <div class="pt-2 text-sm w-5/7 break-all mx-4">{{form.supervisor_sponsors.photo ? form.supervisor_sponsors.photo : 'Ничего не выбрано'}}</div>
                <button title="Удалить" v-bind:class="form.supervisor_sponsors.photo ? 'pt-2 px-4 w-0' : 'invisible'"
                @click.prevent ="form.supervisor_sponsors.photo=''">
                    <icon name="trash" class="block w-4 h-4 fill-red-600" />
                </button>
              </div>
              <button title="Выбрать Фото" class="inline-flex bg-red-600 text-white w-14 h-10 rounded mt-6 cursor-pointer w-auto ml-8 pr-2 items-center" v-on:click.stop.prevent="open = true; imageField='supervisor_sponsors'">
                <svg class="fill-current text-white w-6 h-6 ml-2 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11 9l-3-3-6 6h16l-5-5-2 2zm4-4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                ...
              </button>
            </div>            
          </div>
          <div class="shadow flex flex-wrap w-full mb-6 mr-6"> 
            <template v-for="lang of langs" >
            <div class="flex ml-4 w-full" v-show="lang == current_locale" v-bind:class="(defaultlocale == lang) ? '' :'mr-6'" :key="'supervisor_members-' + lang"> 
              <text-input v-model="form.supervisor_members.name[lang]" class="pt-4 pb-8 pr-8 w-full" label="Работа с участниками" />
              <button v-show="lang != defaultlocale" class="bg-red-600 w-10 h-10 rounded ml-0 mt-10 cursor-pointer" title="Перевести" v-on:click.stop.prevent="translate(defaultlocale, lang, 'form', 'supervisor_members', form.supervisor_members.name[defaultlocale])">
              <svg class="fill-current text-white w-6 h-6 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"/></svg>              
              </button>
            </div>
            </template>
            <text-input v-model="form.supervisor_members.email" type="email" class="ml-4 pr-8 pb-8 w-full" label="E-mail" />
            <div class="flex ml-4 w-full pb-6">
              <div class="flex w-1/6 mr-2 justify-center items-center">
                <img :src="form.supervisor_members.photo ? form.supervisor_members.photo : noImage" v-bind:class="form.supervisor_members.photo ? 'h-16 object-contain bg-gray-400' : 'h-22 object-contain'" >
              </div>
              <div class="flex flex-col w-4/7 mr-4">
                <div class="pr-2 text-md">Фото профиля:</div>
                <div class="pt-2 text-sm w-5/7 break-all mx-4">{{form.supervisor_members.photo ? form.supervisor_members.photo : 'Ничего не выбрано'}}</div>
                <button title="Удалить" v-bind:class="form.supervisor_members.photo ? 'pt-2 px-4 w-0' : 'invisible'"
                @click.prevent ="form.supervisor_members.photo=''">
                    <icon name="trash" class="block w-4 h-4 fill-red-600" />
                </button>
              </div>
              <button title="Выбрать Фото" class="inline-flex bg-red-600 text-white w-14 h-10 rounded mt-6 cursor-pointer w-auto ml-8 pr-2 items-center" v-on:click.stop.prevent="open = true; imageField='supervisor_members'">
                <svg class="fill-current text-white w-6 h-6 ml-2 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 4c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm11 9l-3-3-6 6h16l-5-5-2 2zm4-4a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path></svg>
                ...
              </button>
            </div>
      
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
          <li class="flex items-center" v-for="(breadcrum, index) in fullPatch" :key="breadcrum">
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
        <button class="inline-flex justify-end bg-indigo-600 text-white h-10 ml-5 px-4 py-2 text-sm tracking-wide font-bold rounded"
        @click="showDropzone = !showDropzone">
        <dropzone class="fill-white w-4 h-4 mr-2"> </dropzone>
          <span class="block">Загрузить</span>
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
import Modal from '@/Shared/Modal'
import Dropzone from '@/Shared/Dropzone'
import Folder from '@/Shared/Folder'
import File from '@/Shared/File'
import vue2Dropzone from 'vue2-dropzone'
import 'vue2-dropzone/dist/vue2Dropzone.min.css'
import TextareaInput from '@/Shared/TextareaInput'
import Editor from '@tinymce/tinymce-vue'
import _ from 'lodash'

import DatePick from 'vue-date-pick'
import 'vue-date-pick/dist/vueDatePick.css'

export default {
  metaInfo: { title: 'Редактировать фестиваль' },
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
    DatePick,

  },
  props: {
    festival: Object,
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
        name: JSON.parse(this.festival.name),
        custom_text: JSON.parse(this.festival.custom_text),
        slug: this.festival.slug,
        meta_title: JSON.parse(this.festival.meta_title),
        meta_description: JSON.parse(this.festival.meta_description),
        gallery: JSON.parse(this.festival.gallery),
        city: JSON.parse(this.festival.city),
        supervisor_project: JSON.parse(this.festival.supervisor_project),
        supervisor_sponsors: JSON.parse(this.festival.supervisor_sponsors),
        supervisor_members: JSON.parse(this.festival.supervisor_members),
        phones: JSON.parse(this.festival.phones),
        adress: JSON.parse(this.festival.adress),
        date_start: this.festival.date_start,
        date_end: this.festival.date_end,
        video_url: this.festival.video_url,
        concert_ua_url: this.festival.concert_ua_url,
        is_default: this.festival.is_default,
        google_map_coordinates: this.festival.google_map_coordinates,
        name_ru: this.festival.name_ru,
        status: this.festival.status,
      },
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
          headers: {
            'X-CSRF-TOKEN': token_csrf
          },
          paramName: 'sFilename',
       
          /* dictDefaultMessage: "<dropzone class='fill-white w-4 h-4 mr-2'> </dropzone>UPLOAD ME"  */         
        
      },
 
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
    this.loadFiles();
  },  

  watch: {
    '$page.errors': function (val, oldVal) {
      const objectArray = Object.entries(val);
      var ob = {};
      objectArray.forEach(([key, value]) => {
          this.error_msg[key]= value

      })
    },
  },
  methods: {
/*     phoneChange: _.debounce(function(index, e){
      this.form.phones[index] = e.target.value;

    },500), */
   
    changeSlug(lang){
      if(lang == this.defaultlocale) {
      this.form.slug = this.url_slug(this.form.city[lang]);
      /* console.log(this.form.slug); */
      }
    },
    addPortfolio (index){
      this.imageFieldIndex= index; 
      this.imageField='gallery'; 
      this.open = true; 
    },
    addItem(){
      var k, v = 0;
      for (let [key, value] of Object.entries(this.form.gallery)) {
        k = key;
        v = value;   
      }
      if (v.length>0) {
      this.form.gallery = Object.assign({}, this.form.gallery, {
        [++k]: '',
      })      
      }

    },
    deleteItem(index){
      var lengthKey = (this.form.gallery.length || Object.keys(this.form.gallery).length);
      //console.log('lengthKey='+lengthKey, 'index='+index);
      if (lengthKey>1){
      Vue.delete(this.form.gallery, index)  
      //this.form.portfolio.delete(index);
      } else {
       // this.form.portfolio[index]= '';
        Vue.set( this.form.gallery, index, '' )
      }
    },
    submit() {
      this.sending = true
      this.$inertia.put(this.route('festivals.update', this.festival.id), this.form)
        .then(() => (this.sending = false))
    },
    changeLang: function(e) {
      this.current_locale = e.target.value;
    },
    translate(defaultLang, currentLang, prefix, input, textForTranslate) {
      this.fields.textTranslate = textForTranslate;
      this.fields.defaultLang = defaultLang;
      this.fields.currentLang = currentLang;
   
          
      this.axios.post(this.route('translate.index'), this.fields,{ 'maxContentLength': 100000000,
        'maxBodyLength' : 1000000000}).then(response => {
         //Vue.set(this[prefix][input],currentLang, response.data);
        if(input== 'supervisor_project' || input== 'supervisor_sponsors' || input== 'supervisor_members' ){
          this[prefix][input].name[currentLang] = response.data; 
        } else {         
          this[prefix][input][currentLang] = response.data;
        }
      })
      .catch((err) => {
      console.log(err);

    });      
    },
    selectFile(fName, fIndex="") {

      if(this.imageField== 'supervisor_project' || this.imageField== 'supervisor_sponsors' || this.imageField== 'supervisor_members' ){
        this.form[this.imageField].photo = fName;  
      } else {
        if (fIndex !=="") {
          this.form[this.imageField][this.imageFieldIndex] = fName;
          this.imageFieldIndex ='';
        } else {
          this.form[this.imageField] = fName;  
        }
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
      /* console.log('upload finishe') */
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
    /**
     * Create a web friendly URL slug from a string.
     *
     * Requires XRegExp (http://xregexp.com) with unicode add-ons for UTF-8 support.
     *
     * Although supported, transliteration is discouraged because
     *     1) most web browsers support UTF-8 characters in URLs
     *     2) transliteration causes a loss of information
     *
     * @author Sean Murphy <sean@iamseanmurphy.com>
     * @copyright Copyright 2012 Sean Murphy. All rights reserved.
     * @license http://creativecommons.org/publicdomain/zero/1.0/
     *
     * @param string s
     * @param object opt
     * @return string
     */
    url_slug(s, opt) {
      s = String(s);
      opt = Object(opt);
      
      var defaults = {
        'delimiter': '-',
        'limit': undefined,
        'lowercase': true,
        'replacements': {},
        'transliterate': (typeof(XRegExp) === 'undefined') ? true : false
      };
      
      // Merge options
      for (var k in defaults) {
        if (!opt.hasOwnProperty(k)) {
          opt[k] = defaults[k];
        }
      }
      
      var char_map = {
        // Latin
        'À': 'A', 'Á': 'A', 'Â': 'A', 'Ã': 'A', 'Ä': 'A', 'Å': 'A', 'Æ': 'AE', 'Ç': 'C', 
        'È': 'E', 'É': 'E', 'Ê': 'E', 'Ë': 'E', 'Ì': 'I', 'Í': 'I', 'Î': 'I', 'Ï': 'I', 
        'Ð': 'D', 'Ñ': 'N', 'Ò': 'O', 'Ó': 'O', 'Ô': 'O', 'Õ': 'O', 'Ö': 'O', 'Ő': 'O', 
        'Ø': 'O', 'Ù': 'U', 'Ú': 'U', 'Û': 'U', 'Ü': 'U', 'Ű': 'U', 'Ý': 'Y', 'Þ': 'TH', 
        'ß': 'ss', 
        'à': 'a', 'á': 'a', 'â': 'a', 'ã': 'a', 'ä': 'a', 'å': 'a', 'æ': 'ae', 'ç': 'c', 
        'è': 'e', 'é': 'e', 'ê': 'e', 'ë': 'e', 'ì': 'i', 'í': 'i', 'î': 'i', 'ï': 'i', 
        'ð': 'd', 'ñ': 'n', 'ò': 'o', 'ó': 'o', 'ô': 'o', 'õ': 'o', 'ö': 'o', 'ő': 'o', 
        'ø': 'o', 'ù': 'u', 'ú': 'u', 'û': 'u', 'ü': 'u', 'ű': 'u', 'ý': 'y', 'þ': 'th', 
        'ÿ': 'y',

        // Latin symbols
        '©': '(c)',


        // Russian
        'А': 'A', 'Б': 'B', 'В': 'V', 'Г': 'G', 'Д': 'D', 'Е': 'E', 'Ё': 'Yo', 'Ж': 'Zh',
        'З': 'Z', 'И': 'I', 'Й': 'J', 'К': 'K', 'Л': 'L', 'М': 'M', 'Н': 'N', 'О': 'O',
        'П': 'P', 'Р': 'R', 'С': 'S', 'Т': 'T', 'У': 'U', 'Ф': 'F', 'Х': 'H', 'Ц': 'C',
        'Ч': 'Ch', 'Ш': 'Sh', 'Щ': 'Sh', 'Ъ': '', 'Ы': 'Y', 'Ь': '', 'Э': 'E', 'Ю': 'Yu',
        'Я': 'Ya',
        'а': 'a', 'б': 'b', 'в': 'v', 'г': 'g', 'д': 'd', 'е': 'e', 'ё': 'yo', 'ж': 'zh',
        'з': 'z', 'и': 'i', 'й': 'j', 'к': 'k', 'л': 'l', 'м': 'm', 'н': 'n', 'о': 'o',
        'п': 'p', 'р': 'r', 'с': 's', 'т': 't', 'у': 'u', 'ф': 'f', 'х': 'h', 'ц': 'c',
        'ч': 'ch', 'ш': 'sh', 'щ': 'sh', 'ъ': '', 'ы': 'y', 'ь': '', 'э': 'e', 'ю': 'yu',
        'я': 'ya',

        // Ukrainian
        'Є': 'Ye', 'І': 'I', 'Ї': 'Yi', 'Ґ': 'G',
        'є': 'ye', 'і': 'i', 'ї': 'yi', 'ґ': 'g',

      };
      
      // Make custom replacements
      for (var k in opt.replacements) {
        s = s.replace(RegExp(k, 'g'), opt.replacements[k]);
      }
      
      // Transliterate characters to ASCII
      if (opt.transliterate) {
        for (var k in char_map) {
          s = s.replace(RegExp(k, 'g'), char_map[k]);
        }
      }
      
      // Replace non-alphanumeric characters with our delimiter
      var alnum = (typeof(XRegExp) === 'undefined') ? RegExp('[^a-z0-9]+', 'ig') : XRegExp('[^\\p{L}\\p{N}]+', 'ig');
      s = s.replace(alnum, opt.delimiter);
      
      // Remove duplicate delimiters
      s = s.replace(RegExp('[' + opt.delimiter + ']{2,}', 'g'), opt.delimiter);
      
      // Truncate slug to max. characters
      s = s.substring(0, opt.limit);
      
      // Remove delimiter from ends
      s = s.replace(RegExp('(^' + opt.delimiter + '|' + opt.delimiter + '$)', 'g'), '');
      
      return opt.lowercase ? s.toLowerCase() : s;
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
</style>