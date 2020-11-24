(window.webpackJsonp=window.webpackJsonp||[]).push([[35],{"6NUw":function(t,e,s){"use strict";var a={components:{Dropdown:s("Q7Qx").a},props:{value:String,maxWidth:{type:Number,default:300}}},n=s("KHd+"),r=Object(n.a)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"flex items-center"},[s("div",{staticClass:"flex w-full bg-white shadow rounded"},[s("dropdown",{staticClass:"px-4 md:px-6 rounded-l border-r hover:bg-gray-100 focus:border-white focus:shadow-outline focus:z-10",attrs:{"auto-close":!1,placement:"bottom-start"}},[s("div",{staticClass:"flex items-baseline"},[s("span",{staticClass:"text-gray-700 hidden md:inline"},[t._v("Фильтр")]),t._v(" "),s("svg",{staticClass:"w-2 h-2 fill-gray-700 md:ml-2",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 961.243 599.998"}},[s("path",{attrs:{d:"M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z"}})])]),t._v(" "),s("div",{staticClass:"mt-2 px-4 py-6 w-screen shadow-xl bg-white rounded",style:{maxWidth:t.maxWidth+"px"},attrs:{slot:"dropdown"},slot:"dropdown"},[t._t("default")],2)]),t._v(" "),s("input",{staticClass:"relative w-full px-6 py-3 rounded-r focus:shadow-outline",attrs:{autocomplete:"off",type:"text",name:"search",placeholder:"Поиск..."},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}})],1),t._v(" "),s("button",{staticClass:"ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500",attrs:{type:"button"},on:{click:function(e){return t.$emit("reset")}}},[t._v("Сброс")])])}),[],!1,null,null,null);e.a=r.exports},DORU:function(t,e,s){"use strict";var a={props:{links:Array}},n=s("KHd+"),r=Object(n.a)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"mt-6 -mb-1 flex flex-wrap"},[t._l(t.links,(function(e,a){return[null===e.url?s("div",{key:a,staticClass:"mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400",class:{"ml-auto":"Вперед"===e.label}},[t._v(t._s(e.label))]):s("inertia-link",{key:a,staticClass:"mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500",class:{"bg-white":e.active,"ml-auto":"Вперед"===e.label},attrs:{href:e.url}},[t._v(t._s(e.label))])]}))],2)}),[],!1,null,null,null);e.a=r.exports},RQGu:function(t,e,s){"use strict";s.r(e);var a=s("MY0P"),n=s("+SZM"),r=s("noZS"),i=s.n(r),o=s("DORU"),l=s("d8FT"),c=s.n(l),d=s("DzJC"),u=s.n(d),f=s("ggl3"),p=s("6NUw"),v={metaInfo:{title:"Переводы"},layout:n.a,components:{Icon:a.a,Pagination:o.a,ModalConfirm:f.a,SearchFilter:p.a},props:{translations:Object,filters:Object},data:function(){return{open:!1,record_id:"",form:{search:this.filters.search}}},watch:{form:{handler:u()((function(){var t=c()(this.form);this.$inertia.replace(this.route("translations",Object.keys(t).length?t:{remember:"forget"}))}),150),deep:!0}},methods:{reset:function(){this.form=i()(this.form,(function(){return null}))},showModal:function(t){this.open=!0,this.record_id=t},destroy:function(){this.$inertia.delete(this.route("translations.destroy",this.record_id))}}},h=s("KHd+"),m=Object(h.a)(v,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("h1",{staticClass:"mb-8 font-bold text-3xl"},[t._v("Переводы")]),t._v(" "),s("div",{staticClass:"mb-6 flex justify-between items-center"},[s("div",{staticClass:"flex items-center"},[s("div",{staticClass:"flex w-full bg-white shadow rounded"},[s("input",{directives:[{name:"model",rawName:"v-model",value:t.form.search,expression:"form.search"}],staticClass:"relative w-full px-6 py-3 rounded-r focus:shadow-outline",attrs:{autocomplete:"off",type:"text",name:"search",placeholder:"Поиск..."},domProps:{value:t.form.search},on:{input:[function(e){e.target.composing||t.$set(t.form,"search",e.target.value)},function(e){return t.$emit("input",e.target.value)}]}})]),t._v(" "),s("button",{staticClass:"ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500",attrs:{type:"button"},on:{click:t.reset}},[t._v("Сброс")])]),t._v(" "),s("inertia-link",{staticClass:"btn-indigo text-white hover:bg-red-600 focus:bg-red-600",attrs:{href:t.route("translations.create")}},[s("span",[t._v("Создать")])])],1),t._v(" "),s("div",{staticClass:"bg-white rounded shadow overflow-x-auto"},[s("table",{staticClass:"w-full whitespace-no-wrap"},[t._m(0),t._v(" "),t._l(t.translations.data,(function(e,a){return s("tr",{key:e.id,staticClass:"hover:bg-gray-100 focus-within:bg-gray-100"},[s("td",{staticClass:"border-t px-6 py-4 w-2"},[t._v("\n        "+t._s(a+1)+"\n        ")]),t._v(" "),s("td",{staticClass:"border-t"},[t._v("\n          "+t._s(e.group)+"\n        ")]),t._v(" "),s("td",{staticClass:"border-t"},[t._v("\n          "+t._s(e.key)+"\n        ")]),t._v(" "),s("td",{staticClass:"border-t",attrs:{colspan:"3"}},[t._v("\n          "+t._s(t._f("truncate")(e.text,35,"..."))+"\n        ")]),t._v(" "),s("td",{staticClass:"flex pt-3 justify-end border-t"},[s("inertia-link",{staticClass:"px-4",attrs:{href:t.route("translations.edit",e.id),tabindex:"-1"}},[s("icon",{staticClass:"block w-6 h-6 fill-green-600",attrs:{name:"edit"}})],1),t._v(" "),s("button",{staticClass:"px-4",on:{click:function(s){return s.preventDefault(),t.showModal(e.id)}}},[s("icon",{staticClass:"block w-6 h-6 fill-red-600",attrs:{name:"trash"}})],1)],1)])})),t._v(" "),0===t.translations.data.length?s("tr",[s("td",{staticClass:"border-t px-6 py-4",attrs:{colspan:"7"}},[t._v("Нет записей")])]):t._e()],2)]),t._v(" "),s("pagination",{attrs:{links:t.translations.links}}),t._v(" "),s("modal-confirm",{attrs:{showing:t.open},on:{close:function(e){t.open=!1}}},[s("h2",{staticClass:"text-xl font-bold text-gray-900 h-10 pt-6 mb-10"},[t._v("Вы дейсвительно хотите удалить запись?")]),t._v(" "),s("div",{staticClass:"flex justify-end"},[s("button",{staticClass:"justify-end bg-indigo-600 text-white h-10 px-4 py-2 text-sm tracking-wide font-bold rounded",on:{click:function(e){t.open=!1}}},[t._v("\n        Отмена\n      ")]),t._v(" "),s("button",{staticClass:"inline-flex justify-end bg-red-600 text-white h-10 ml-5 px-4 py-2 text-sm tracking-wide font-bold rounded",on:{click:t.destroy}},[s("span",{staticClass:"block"},[t._v("Подтвердить")])])])])],1)}),[function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("tr",{staticClass:"text-left font-bold"},[s("th",{staticClass:"px-6 pt-6 pb-4"},[t._v("#")]),t._v(" "),s("th",{staticClass:"px-6 pt-6 pb-4"},[t._v("Группа")]),t._v(" "),s("th",{staticClass:"px-6 pt-6 pb-4"},[t._v("Ключ")]),t._v(" "),s("th",{staticClass:"px-6 pt-6 pb-4",attrs:{colspan:"3"}},[t._v("Текст")]),t._v(" "),s("th",{staticClass:"px-6 pt-6 pb-4"})])}],!1,null,null,null);e.default=m.exports},ad0i:function(t,e,s){"use strict";var a=s("gNdk");s.n(a).a},fpro:function(t,e,s){(t.exports=s("I1BE")(!1)).push([t.i,"\n.fade-enter-active[data-v-415cb726],\r\n.fade-leave-active[data-v-415cb726] {\r\n  transition: all 0.4s;\n}\n.fade-enter[data-v-415cb726],\r\n.fade-leave-to[data-v-415cb726] {\r\n  opacity: 0;\n}\r\n",""])},gNdk:function(t,e,s){var a=s("fpro");"string"==typeof a&&(a=[[t.i,a,""]]);var n={hmr:!0,transform:void 0,insertInto:void 0};s("aET+")(a,n);a.locals&&(t.exports=a.locals)},ggl3:function(t,e,s){"use strict";var a={props:{showing:{required:!0,type:Boolean}},watch:{showing:function(t){if(t)return document.querySelector("body").classList.add("overflow-hidden");document.querySelector("body").classList.remove("overflow-hidden")}},methods:{close:function(){this.$emit("close")}}},n=(s("ad0i"),s("KHd+")),r=Object(n.a)(a,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("Transition",{attrs:{name:"fade"}},[t.showing?s("div",{staticClass:"fixed inset-x-0 bottom-0 -top-32 w-full h-screen flex items-center justify-center bg-semi-75",on:{click:function(e){return e.target!==e.currentTarget?null:t.close(e)}}},[s("div",{staticClass:"relative w-full max-w-md bg-white shadow-my rounded-lg p-4 mt-5"},[t._t("default")],2)]):t._e()])}),[],!1,null,"415cb726",null);e.a=r.exports}}]);
//# sourceMappingURL=35.chunk.24afc8e7273e91b4e1f4.js.map