(window.webpackJsonp=window.webpackJsonp||[]).push([[34],{"6NUw":function(t,s,e){"use strict";var a={components:{Dropdown:e("Q7Qx").a},props:{value:String,maxWidth:{type:Number,default:300}}},n=e("KHd+"),r=Object(n.a)(a,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"flex items-center"},[e("div",{staticClass:"flex w-full bg-white shadow rounded"},[e("dropdown",{staticClass:"px-4 md:px-6 rounded-l border-r hover:bg-gray-100 focus:border-white focus:shadow-outline focus:z-10",attrs:{"auto-close":!1,placement:"bottom-start"}},[e("div",{staticClass:"flex items-baseline"},[e("span",{staticClass:"text-gray-700 hidden md:inline"},[t._v("Фильтр")]),t._v(" "),e("svg",{staticClass:"w-2 h-2 fill-gray-700 md:ml-2",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 961.243 599.998"}},[e("path",{attrs:{d:"M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z"}})])]),t._v(" "),e("div",{staticClass:"mt-2 px-4 py-6 w-screen shadow-xl bg-white rounded",style:{maxWidth:t.maxWidth+"px"},attrs:{slot:"dropdown"},slot:"dropdown"},[t._t("default")],2)]),t._v(" "),e("input",{staticClass:"relative w-full px-6 py-3 rounded-r focus:shadow-outline",attrs:{autocomplete:"off",type:"text",name:"search",placeholder:"Поиск..."},domProps:{value:t.value},on:{input:function(s){return t.$emit("input",s.target.value)}}})],1),t._v(" "),e("button",{staticClass:"ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500",attrs:{type:"button"},on:{click:function(s){return t.$emit("reset")}}},[t._v("Сброс")])])}),[],!1,null,null,null);s.a=r.exports},DORU:function(t,s,e){"use strict";var a={props:{links:Array}},n=e("KHd+"),r=Object(n.a)(a,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"mt-6 -mb-1 flex flex-wrap"},[t._l(t.links,(function(s,a){return[null===s.url?e("div",{key:a,staticClass:"mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400",class:{"ml-auto":"Вперед"===s.label}},[t._v(t._s(s.label))]):e("inertia-link",{key:a,staticClass:"mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500",class:{"bg-white":s.active,"ml-auto":"Вперед"===s.label},attrs:{href:s.url}},[t._v(t._s(s.label))])]}))],2)}),[],!1,null,null,null);s.a=r.exports},ad0i:function(t,s,e){"use strict";var a=e("gNdk");e.n(a).a},fpro:function(t,s,e){(t.exports=e("I1BE")(!1)).push([t.i,"\n.fade-enter-active[data-v-415cb726],\r\n.fade-leave-active[data-v-415cb726] {\r\n  transition: all 0.4s;\n}\n.fade-enter[data-v-415cb726],\r\n.fade-leave-to[data-v-415cb726] {\r\n  opacity: 0;\n}\r\n",""])},gNdk:function(t,s,e){var a=e("fpro");"string"==typeof a&&(a=[[t.i,a,""]]);var n={hmr:!0,transform:void 0,insertInto:void 0};e("aET+")(a,n);a.locals&&(t.exports=a.locals)},ggl3:function(t,s,e){"use strict";var a={props:{showing:{required:!0,type:Boolean}},watch:{showing:function(t){if(t)return document.querySelector("body").classList.add("overflow-hidden");document.querySelector("body").classList.remove("overflow-hidden")}},methods:{close:function(){this.$emit("close")}}},n=(e("ad0i"),e("KHd+")),r=Object(n.a)(a,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("Transition",{attrs:{name:"fade"}},[t.showing?e("div",{staticClass:"fixed inset-x-0 bottom-0 -top-32 w-full h-screen flex items-center justify-center bg-semi-75",on:{click:function(s){return s.target!==s.currentTarget?null:t.close(s)}}},[e("div",{staticClass:"relative w-full max-w-md bg-white shadow-my rounded-lg p-4 mt-5"},[t._t("default")],2)]):t._e()])}),[],!1,null,"415cb726",null);s.a=r.exports},jbyU:function(t,s,e){"use strict";e.r(s);var a=e("MY0P"),n=e("+SZM"),r=e("noZS"),o=e.n(r),i=e("DORU"),l=e("d8FT"),c=e.n(l),d=e("DzJC"),u=e.n(d),p=e("ggl3"),v=e("6NUw"),f={metaInfo:{title:"Заявки на участие"},layout:n.a,components:{Icon:a.a,Pagination:i.a,ModalConfirm:p.a,SearchFilter:v.a},props:{proposals:Object,filters:Object},data:function(){return{form:{search:this.filters.search,status:this.filters.status_id},open:!1,record_id:""}},watch:{form:{handler:u()((function(){var t=c()(this.form);this.$inertia.replace(this.route("proposals",Object.keys(t).length?t:{remember:"forget"}))}),150),deep:!0}},methods:{reset:function(){this.form=o()(this.form,(function(){return null}))},showModal:function(t){this.open=!0,this.record_id=t},destroy:function(){this.$inertia.delete(this.route("proposals.destroy",this.record_id))}}},_=e("KHd+"),m=Object(_.a)(f,(function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",[e("h1",{staticClass:"mb-8 font-bold text-3xl"},[t._v("Заявки на участие")]),t._v(" "),e("div",{staticClass:"mb-6 flex justify-between items-center"},[e("search-filter",{staticClass:"w-full max-w-md mr-4",on:{reset:t.reset},model:{value:t.form.search,callback:function(s){t.$set(t.form,"search",s)},expression:"form.search"}},[e("label",{staticClass:"block text-gray-700"},[t._v("Статус:")]),t._v(" "),e("select",{directives:[{name:"model",rawName:"v-model",value:t.form.status,expression:"form.status"}],staticClass:"mt-1 w-full form-select",on:{change:function(s){var e=Array.prototype.filter.call(s.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.form,"status",s.target.multiple?e:e[0])}}},[e("option",{domProps:{value:null}}),t._v(" "),e("option",{attrs:{value:"1"}},[t._v("Новая")]),t._v(" "),e("option",{attrs:{value:"2"}},[t._v("Ожидаем оплату")]),t._v(" "),e("option",{attrs:{value:"3"}},[t._v("Оплачена")]),t._v(" "),e("option",{attrs:{value:"4"}},[t._v("Отменена")])])]),t._v(" "),e("inertia-link",{staticClass:"btn-indigo text-white hover:bg-red-600 focus:bg-red-600",attrs:{href:t.route("proposals.create")}},[e("span",[t._v("Создать")])])],1),t._v(" "),e("div",{staticClass:"bg-white rounded shadow overflow-x-auto"},[e("table",{staticClass:"w-full whitespace-no-wrap"},[t._m(0),t._v(" "),t._l(t.proposals.data,(function(s,a){return e("tr",{key:s.id,staticClass:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",{staticClass:"border-t px-6 py-4 w-2"},[t._v("\n        "+t._s(a+1)+"\n        ")]),t._v(" "),e("td",{staticClass:"border-t"},[t._v("\n          "+t._s(s.member)+"\n        ")]),t._v(" "),e("td",{staticClass:"border-t"},[t._v("\n          "+t._s(s.studio)+"\n        ")]),t._v(" "),e("td",{staticClass:"border-t"},[s.specialization?e("div",[t._v("\n            "+t._s(JSON.parse(s.specialization.name)[t.defaultlocale])+"\n          ")]):t._e()]),t._v(" "),e("td",{staticClass:"border-t "},[s.country?e("div",[t._v("\n            "+t._s(JSON.parse(s.country.name)[t.defaultlocale])+"\n          ")]):t._e()]),t._v(" "),e("td",{staticClass:"border-t "},[s.festival?e("div",[t._v("\n            "+t._s(JSON.parse(s.festival.name)[t.defaultlocale])+"\n          ")]):t._e()]),t._v(" "),e("td",{staticClass:"border-t"},[t._v("\n          "+t._s(s.date)+"\n        ")]),t._v(" "),e("td",{staticClass:"border-t"},[1===s.status?e("span",[t._v("\n            Новая\n          ")]):2===s.status?e("span",[t._v("\n            Ожидаем оплату\n          ")]):3===s.status?e("span",[t._v("\n            Оплачена\n          ")]):4===s.status?e("span",[t._v("\n            Отменена\n          ")]):e("span")]),t._v(" "),e("td",{staticClass:"border-t"},[t._v("\n          "+t._s(s.place_number)+"\n        ")]),t._v(" "),e("td",{staticClass:"flex pt-3 justify-end border-t"},[e("inertia-link",{staticClass:"px-2",attrs:{href:t.route("proposals.edit",s.id),tabindex:"-1"}},[e("icon",{staticClass:"block w-6 h-6 fill-green-600",attrs:{name:"edit"}})],1),t._v(" "),e("button",{staticClass:"px-2",on:{click:function(e){return e.preventDefault(),t.showModal(s.id)}}},[e("icon",{staticClass:"block w-6 h-6 fill-red-600",attrs:{name:"trash"}})],1),t._v(" "),3===s.status?e("inertia-link",{staticClass:"px-2",attrs:{href:t.route("members.createfromproposal",s),tabindex:"-1"}},[e("icon",{staticClass:"block w-6 h-6 fill-indigo-400",attrs:{name:"pen-tool"}})],1):t._e()],1)])})),t._v(" "),0===t.proposals.data.length?e("tr",[e("td",{staticClass:"border-t px-6 py-4",attrs:{colspan:"8"}},[t._v("Нет записей")])]):t._e()],2)]),t._v(" "),e("pagination",{attrs:{links:t.proposals.links}}),t._v(" "),e("modal-confirm",{attrs:{showing:t.open},on:{close:function(s){t.open=!1}}},[e("h2",{staticClass:"text-xl font-bold text-gray-900 h-10 pt-6 mb-10"},[t._v("Вы дейсвительно хотите удалить запись?")]),t._v(" "),e("div",{staticClass:"flex justify-end"},[e("button",{staticClass:"justify-end bg-indigo-600 text-white h-10 px-4 py-2 text-sm tracking-wide font-bold rounded",on:{click:function(s){t.open=!1}}},[t._v("\n        Отмена\n      ")]),t._v(" "),e("button",{staticClass:"inline-flex justify-end bg-red-600 text-white h-10 ml-5 px-4 py-2 text-sm tracking-wide font-bold rounded",on:{click:t.destroy}},[e("span",{staticClass:"block"},[t._v("Подтвердить")])])])])],1)}),[function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("tr",{staticClass:"text-left font-bold"},[e("th",{staticClass:"px-6 pt-6 pb-4"},[t._v("#")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("Участник")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("Студия")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("Специализация")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("Страна")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("Фестиваль")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("Дата")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("Статус")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"},[t._v("№ места")]),t._v(" "),e("th",{staticClass:"px-2 pt-6 pb-4"})])}],!1,null,null,null);s.default=m.exports}}]);
//# sourceMappingURL=34.chunk.42bce6753da0b0d306e9.js.map