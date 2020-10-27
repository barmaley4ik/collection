<template>
        <div class="flex flex-col sm:flex-row pt-6 justify-center">
            <div class="w-full md:w-1/2 xl:w-1/3 bg-white border border-gray-100 rounded shadow m-2 h-24">
                <inertia-link class="flex justify-center group p-2" :href="route('festivals')">
                    <icon name="announcement" class="w-4 h-4 mr-2 fill-indigo-600" />
                    <h5 class="font-bold text-sm tracking-wide text-indigo-600 uppercase items-center">Фестивали</h5>
                </inertia-link>
                <div class="flex-1 text-right md:text-center">
                    <br>
                    <h3 class="font-bold text-2xl text-gray-800  text-center">{{festivals}}</h3>
                </div>                
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 bg-white border border-gray-100 rounded shadow m-2 h-24">
                <inertia-link class="flex justify-center group p-2" :href="route('members')">
                    <icon name="pen-tool" class="w-4 h-4 mr-2 fill-indigo-600" />
                    <h5 class="font-bold text-sm tracking-wide text-indigo-600 uppercase items-center">участники</h5>
                </inertia-link>
                <div class="flex-1 text-right md:text-center">
                    <br>
                    <h3 class="font-bold text-2xl text-gray-800  text-center">{{members}}</h3>
                </div>                
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 bg-white border border-gray-100 rounded shadow m-2 h-24">
                <inertia-link class="flex justify-center group p-2" :href="route('partners')">
                    <icon name="usergroup" class="w-4 h-4 mr-2 fill-indigo-600" />
                    <h5 class="font-bold text-sm tracking-wide text-indigo-600 uppercase items-center">партнеры</h5>
                </inertia-link>
                <div class="flex-1 text-right md:text-center">
                    <br>
                    <h3 class="font-bold text-2xl text-gray-800  text-center">{{partners}}</h3>
                </div>                
            </div>
            <div class="w-full md:w-1/2 xl:w-1/3 bg-white border border-gray-100 rounded shadow m-2 h-24">
                <inertia-link class="flex justify-center group p-2" :href="route('proposals')">
                    <icon name="envelope" class="w-4 h-4 mr-2 fill-indigo-600" />
                    <h5 class="font-bold text-sm tracking-wide text-indigo-600 uppercase items-center">Заявки</h5>
                </inertia-link>
                <div class="flex-1 text-right md:text-center">
                    <br>
                    <h3 class="font-bold text-2xl text-gray-800  text-center">{{proposals}}</h3>
                </div>                
            </div>                                            
            <div class="w-full md:w-1/2 xl:w-1/3 bg-white border border-gray-100 rounded shadow m-2 h-24">
                <inertia-link class="flex justify-center group p-2" :href="route('biz-proposals')">
                    <icon name="store-front" class="w-4 h-4 mr-2 fill-indigo-600" />
                    <h5 class="font-bold text-sm tracking-wide text-indigo-600 uppercase items-center">Заявки на ТМ</h5>
                </inertia-link>
                <div class="flex-1 text-right md:text-center">
                    <br>
                    <h3 class="font-bold text-2xl text-gray-800  text-center">{{biz_proposals}}</h3>
                </div>                
            </div>           
       </div>
</template>

<script>
import Layout from '@/Shared/Layout'
import Icon from '@/Shared/Icon'

export default {
  metaInfo: { title: 'Dashboard' },
  layout: Layout,
  components: {
    Icon,
  },
  props: {
    proposals: Number,
    biz_proposals: Number,
    festivals: Number,  
    members: Number,  
    partners: Number,  

  },    
}
</script>
