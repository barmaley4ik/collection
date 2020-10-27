<template>
  <div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('proposals')">
        <icon name="envelope" class="w-4 h-4 mr-2" :class="isUrl('admin/proposals') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/proposals') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Заявки</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('biz-proposals')">
        <icon name="store-front" class="w-4 h-4 mr-2" :class="isUrl('admin/biz-proposals') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/biz-proposals') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Заявки на ТМ</div>
      </inertia-link>
    </div>        
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('festivals')">
        <icon name="announcement" class="w-4 h-4 mr-2" :class="isUrl('admin/festivals') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/festivals') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Фестивали</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('sliders')">
        <icon name="photo" class="w-4 h-4 mr-2" :class="isUrl('admin/sliders') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/sliders') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Слайдеры</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('conditions')">
        <icon name="exclamation-outline" class="w-4 h-4 mr-2" :class="isUrl('admin/conditions') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/conditions') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Условия</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('dispositions')">
        <icon name="location" class="w-4 h-4 mr-2" :class="isUrl('admin/dispositions') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/dispositions') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Размещения</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('hotels')">
        <icon name="home" class="w-4 h-4 mr-2" :class="isUrl('admin/hotels') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/hotels') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Проживание</div>
      </inertia-link>
    </div>                
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('programs')">
        <icon name="document" class="w-4 h-4 mr-2" :class="isUrl('admin/programs') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/programs') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Программы</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('nominations')">
        <icon name="trophy" class="w-4 h-4 mr-2" :class="isUrl('admin/nominations') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/nominations') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Номинации</div>
      </inertia-link>
    </div>                      
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('members')">
        <icon name="pen-tool" class="w-4 h-4 mr-2" :class="isUrl('admin/members') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/members') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Участники</div>
      </inertia-link>
    </div>      
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('partners')">
        <icon name="usergroup" class="w-4 h-4 mr-2" :class="isUrl('admin/partners') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/partners') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Партнеры</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('specializations')">
        <icon name="education" class="w-4 h-4 mr-2" :class="isUrl('admin/specializations') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/specializations') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Специализации</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('placeformats')">
        <icon name="layers" class="w-4 h-4 mr-2" :class="isUrl('admin/placeformats') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/placeformats') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Форматы мест</div>
      </inertia-link>
    </div>               
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('countries')">
        <icon name="globe" class="w-4 h-4 mr-2" :class="isUrl('admin/countries') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/countries') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Страны</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('languages')">
        <icon name="network" class="w-4 h-4 mr-2" :class="isUrl('admin/languages') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/languages') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Языки</div>
      </inertia-link>
    </div>
    <div>
      <inertia-link class="flex items-center group py-3" :href="route('translations')">
        <icon name="translate" class="w-4 h-4 mr-2" :class="isUrl('admin/translations') ? 'fill-white' : 'fill-indigo-400 group-hover:fill-white'" />
        <div :class="isUrl('admin/translations') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">Переводы</div>
      </inertia-link>
    </div>         
  </div>
</template>

<script>
import Icon from '@/Shared/Icon'

export default {
  components: {
    Icon,
  },
  props: {
    url: String,
  },
  methods: {
    isUrl(...urls) {
      if (urls[0] === '') {
        return this.url === ''
      }

      return urls.filter(url => this.url.startsWith(url)).length
    },
  },
}
</script>
