(window.webpackJsonp=window.webpackJsonp||[]).push([[32],{NtI5:function(t,e,r){var n=r("W9UR");"string"==typeof n&&(n=[[t.i,n,""]]);var a={hmr:!0,transform:void 0,insertInto:void 0};r("aET+")(n,a);n.locals&&(t.exports=n.locals)},Ujtf:function(t,e,r){"use strict";var n={inheritAttrs:!1,props:{id:{type:String,default:function(){return"select-input-".concat(this._uid)}},value:[String,Number,Boolean],label:String,errors:{type:Array,default:function(){return[]}}},data:function(){return{selected:this.value}},watch:{selected:function(t){this.$emit("input",t)}},methods:{focus:function(){this.$refs.input.focus()},select:function(){this.$refs.input.select()}}},a=r("KHd+"),i=Object(a.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.label?r("label",{staticClass:"form-label",attrs:{for:t.id}},[t._v(t._s(t.label)+":")]):t._e(),t._v(" "),r("select",t._b({directives:[{name:"model",rawName:"v-model",value:t.selected,expression:"selected"}],ref:"input",staticClass:"form-select",class:{error:t.errors.length},attrs:{id:t.id},on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.selected=e.target.multiple?r:r[0]}}},"select",t.$attrs,!1),[t._t("default")],2),t._v(" "),t.errors.length?r("div",{staticClass:"form-error"},[t._v(t._s(t.errors[0]))]):t._e()])}),[],!1,null,null,null);e.a=i.exports},VHNs:function(t,e,r){"use strict";r.r(e);var n=r("+SZM"),a=r("Z84v"),i=r("pF+r"),s=r("ynI1"),o=r("MY0P"),l=r("Ujtf"),u=r("8MqK"),c=r.n(u);r("bzzX");function d(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(t)))return;var r=[],n=!0,a=!1,i=void 0;try{for(var s,o=t[Symbol.iterator]();!(n=(s=o.next()).done)&&(r.push(s.value),!e||r.length!==e);n=!0);}catch(t){a=!0,i=t}finally{try{n||null==o.return||o.return()}finally{if(a)throw i}}return r}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return f(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return f(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function f(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}var p={metaInfo:{title:"Создать фестиваль"},layout:n.a,components:{LoadingButton:a.a,TextInput:i.a,Editor:s.a,Icon:o.a,SelectInput:l.a,DatePick:c.a},props:{nomination:Object,festivals:Array,nextMonthCaption:{type:String,default:"Следующий месяц"},prevMonthCaption:{type:String,default:"Предыдущий месяц"},setTimeCaption:{type:String,default:"Выбрать время:"},weekdays:{type:Array,default:function(){return["Пн","Вт","Ср","Чт","Пт","Сб","Вс"]}},months:{type:Array,default:function(){return["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"]}}},remember:{data:["form"]},data:function(){return{current_locale:"",sending:!1,form:{text_day:JSON.parse(this.nomination.text_day),day:this.nomination.day,festival_id:this.nomination.festival_id},fests:this.festivals,error_msg:{}}},created:function(){this.current_locale=this.defaultlocale},watch:{"$page.errors":function(t,e){var r=this;Object.entries(t).forEach((function(t){var e=d(t,2),n=e[0],a=e[1];r.error_msg[n]=a}))}},methods:{submit:function(){var t=this;this.sending=!0,this.$inertia.put(this.route("nominations.update",this.nomination.id),this.form).then((function(){return t.sending=!1}))},changeLang:function(t){this.current_locale=t.target.value},translate:function(t,e,r,n,a){var i=this;this.fields.textTranslate=a,this.fields.defaultLang=t,this.fields.currentLang=e,this.axios.post(this.route("translate.index"),this.fields).then((function(t){i[r][n][e]=t.data}))}}},m=(r("Xovz"),r("KHd+")),v=Object(m.a)(p,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("h1",{staticClass:"mb-8 font-bold text-3xl"},[r("inertia-link",{staticClass:"text-indigo-400 hover:text-indigo-600",attrs:{href:t.route("nominations")}},[t._v("Номинации")]),t._v(" "),r("span",{staticClass:"text-indigo-400 font-medium"},[t._v("/Создать")])],1),t._v(" "),r("div",{staticClass:"bg-white rounded shadow overflow-hidden max-w-3xl"},[r("div",{staticClass:"bg-white border-none w-full px-8 ml-1 text-md flex justify-end items-center"},t._l(t.langs,(function(e){return r("button",{key:e,staticClass:"w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300",class:t.current_locale==e?"bg-red-600":"bg-indigo-600",attrs:{value:e},on:{click:function(e){return t.changeLang(e)}}},[t._v(t._s(e))])})),0),t._v(" "),r("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[r("div",{staticClass:"p-8 -mr-6 -mb-8 flex flex-wrap"},[r("div",{staticClass:"pr-6 pb-8 w-full lg:w-1/2"},[r("label",{staticClass:"form-label",attrs:{for:"date-day"}},[t._v("Дата:")]),t._v(" "),r("date-pick",{class:t.error_msg.day?"error form-input":"form-input",attrs:{displayFormat:"DD.MM.YYYY",format:"YYYY-MM-DD",inputAttributes:{readonly:!0,required:!0,id:"date-day"},nextMonthCaption:t.nextMonthCaption,prevMonthCaption:t.prevMonthCaption,setTimeCaption:t.setTimeCaption,weekdays:t.weekdays,months:t.months},model:{value:t.form.day,callback:function(e){t.$set(t.form,"day",e)},expression:"form.day"}}),t._v(" "),t.error_msg.day?r("div",{staticClass:"form-error"},[t._v(t._s(t.error_msg.day[0]))]):t._e()],1),t._v(" "),r("select-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{label:"Фестивали"},model:{value:t.form.festival_id,callback:function(e){t.$set(t.form,"festival_id",e)},expression:"form.festival_id"}},[r("option",{domProps:{value:null}}),t._v(" "),t._l(t.fests,(function(e){return r("option",{key:e.id,domProps:{value:e.id}},[t._v(t._s(JSON.parse(e.name)[t.defaultlocale]))])}))],2),t._v(" "),t._l(t.langs,(function(e){return[r("div",{directives:[{name:"show",rawName:"v-show",value:e==t.current_locale,expression:"lang == current_locale"}],key:"text_day"+e,staticClass:"flex w-full flex-col pb-8 pr-6"},[r("label",{staticClass:"form-label"},[t._v("Текст:")]),t._v(" "),r("div",{staticClass:"w-full",class:t.defaultlocale==e?"":"flex"},[r("editor",{attrs:{name:"text_day["+e+"]",init:{plugins:"autolink lists hr anchor searchreplace visualblocks code insertdatetime media paste",height:400,language:"ru",skin:"oxide",branding:!1,menubar:"format",toolbar:"styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | code "}},model:{value:t.form.text_day[e],callback:function(r){t.$set(t.form.text_day,e,r)},expression:"form.text_day[lang]"}}),t._v(" "),r("button",{directives:[{name:"show",rawName:"v-show",value:e!=t.defaultlocale,expression:"lang != defaultlocale"}],staticClass:"bg-red-600 w-10 h-10 rounded ml-10 cursor-pointer",attrs:{title:"Перевести"},on:{click:function(r){return r.stopPropagation(),r.preventDefault(),t.translate(t.defaultlocale,e,"form","text_day",t.form.text_day[t.defaultlocale])}}},[r("svg",{staticClass:"fill-current text-white w-6 h-6 ml-2",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"}},[r("path",{attrs:{d:"M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"}})])])],1),t._v(" "),t.error_msg["text_day."+e]?r("div",{staticClass:"form-error"},[t._v(t._s(t.error_msg["text_day."+e][0]))]):t._e()])]}))],2),t._v(" "),r("div",{staticClass:"px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"},[r("loading-button",{staticClass:"btn-indigo text-white hover:bg-red-600 focus:bg-red-600",attrs:{loading:t.sending,type:"submit"}},[t._v("Сохранить")])],1)])])])}),[],!1,null,null,null);e.default=v.exports},W9UR:function(t,e,r){(t.exports=r("I1BE")(!1)).push([t.i,"\n.tox .tox-editor-header {\n    z-index: 0 !important;\n}\n.vdpWithInput > input {\n    font-size: 1rem !important;\n}\n",""])},Xovz:function(t,e,r){"use strict";var n=r("NtI5");r.n(n).a},Z84v:function(t,e,r){"use strict";var n={props:{loading:Boolean}},a=r("KHd+"),i=Object(a.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("button",{staticClass:"flex items-center",attrs:{disabled:this.loading}},[this.loading?e("div",{staticClass:"btn-spinner mr-2"}):this._e(),this._v(" "),this._t("default")],2)}),[],!1,null,null,null);e.a=i.exports},"pF+r":function(t,e,r){"use strict";var n={inheritAttrs:!1,props:{id:{type:String,default:function(){return"text-input-".concat(this._uid)}},type:{type:String,default:"text"},value:String,label:String,errors:{type:Array,default:function(){return[]}}},methods:{focus:function(){this.$refs.input.focus()},select:function(){this.$refs.input.select()},setSelectionRange:function(t,e){this.$refs.input.setSelectionRange(t,e)}}},a=r("KHd+"),i=Object(a.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.label?r("label",{staticClass:"form-label",attrs:{for:t.id}},[t._v(t._s(t.label)+":")]):t._e(),t._v(" "),r("input",t._b({ref:"input",staticClass:"form-input",class:{error:t.errors.length},attrs:{id:t.id,type:t.type},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},"input",t.$attrs,!1)),t._v(" "),t.errors.length?r("div",{staticClass:"form-error"},[t._v(t._s(t.errors[0]))]):t._e()])}),[],!1,null,null,null);e.a=i.exports}}]);
//# sourceMappingURL=32.chunk.f76a752e07d67828d80a.js.map