(window.webpackJsonp=window.webpackJsonp||[]).push([[59],{GkZh:function(t,e,r){"use strict";r.r(e);var n=r("+SZM"),a=r("Z84v"),s=r("pF+r");function l(t,e){return function(t){if(Array.isArray(t))return t}(t)||function(t,e){if("undefined"==typeof Symbol||!(Symbol.iterator in Object(t)))return;var r=[],n=!0,a=!1,s=void 0;try{for(var l,i=t[Symbol.iterator]();!(n=(l=i.next()).done)&&(r.push(l.value),!e||r.length!==e);n=!0);}catch(t){a=!0,s=t}finally{try{n||null==i.return||i.return()}finally{if(a)throw s}}return r}(t,e)||function(t,e){if(!t)return;if("string"==typeof t)return i(t,e);var r=Object.prototype.toString.call(t).slice(8,-1);"Object"===r&&t.constructor&&(r=t.constructor.name);if("Map"===r||"Set"===r)return Array.from(t);if("Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r))return i(t,e)}(t,e)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}function i(t,e){(null==e||e>t.length)&&(e=t.length);for(var r=0,n=new Array(e);r<e;r++)n[r]=t[r];return n}var o={metaInfo:{title:"Создать язык"},layout:n.a,components:{LoadingButton:a.a,TextInput:s.a},remember:"form",data:function(){return{current_locale:"",sending:!1,form:{name:{},code:null,encoding:null,status:1,is_default:0},error_msg:{}}},created:function(){this.current_locale=this.defaultlocale;var t={};langs.forEach((function(e,r,n){return t[e]="",t})),this.form.name=t;var e={};this.langs.forEach((function(t,r,n){return e["name."+t]=[],e})),this.error_msg=e},watch:{"$page.errors":function(t,e){var r=this;Object.entries(t).forEach((function(t){var e=l(t,2),n=e[0],a=e[1];0==n.indexOf("name")&&(r.error_msg[n]=a)}))}},methods:{submit:function(){var t=this;this.sending=!0,this.$inertia.post(this.route("languages.store"),this.form).then((function(){return t.sending=!1}))},changeLang:function(t){this.current_locale=t.target.value},translate:function(t,e,r,n,a){var s=this;this.fields.textTranslate=a,this.fields.defaultLang=t,this.fields.currentLang=e,this.axios.post(this.route("translate.index"),this.fields).then((function(t){s[r][n][e]=t.data[0].toUpperCase()+t.data.substr(1)}))}}},u=r("KHd+"),c=Object(u.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("h1",{staticClass:"mb-8 font-bold text-3xl"},[r("inertia-link",{staticClass:"text-indigo-400 hover:text-indigo-600",attrs:{href:t.route("languages")}},[t._v("Языки")]),t._v(" "),r("span",{staticClass:"text-indigo-400 font-medium"},[t._v("/")]),t._v("Создать\n  ")],1),t._v(" "),r("div",{staticClass:"bg-white rounded shadow overflow-hidden max-w-3xl"},[r("div",{staticClass:"bg-white border-none w-full p-4 md:py-0 md:px-8 text-md md:text-md flex justify-end items-center"},t._l(t.langs,(function(e){return r("button",{staticClass:"w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300",class:t.current_locale==e?"bg-red-600":"bg-indigo-600",attrs:{value:e},on:{click:function(e){return t.changeLang(e)}}},[t._v(t._s(e))])})),0),t._v(" "),r("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[r("div",{staticClass:"p-8 -mr-6 -mb-8 flex flex-wrap"},[t._l(t.langs,(function(e){return r("div",{directives:[{name:"show",rawName:"v-show",value:e==t.current_locale,expression:"lang == current_locale"}],staticClass:"flex flex-wrap w-full lg:w-1/2"},[r("text-input",{staticClass:"pb-8",class:t.defaultlocale==e?"pr-6 w-full":"w-6/7 lg:w-5/6 lg:pr-6",attrs:{errors:t.error_msg["name."+e],label:"Наименование"},model:{value:t.form.name[e],callback:function(r){t.$set(t.form.name,e,r)},expression:"form.name[lang]"}}),t._v(" "),r("button",{directives:[{name:"show",rawName:"v-show",value:e!=t.defaultlocale,expression:"lang != defaultlocale"}],staticClass:"bg-red-600 w-10 h-10 rounded ml-6 mt-6 lg:ml-0 cursor-pointer",attrs:{title:"Перевести"},on:{click:function(r){return r.stopPropagation(),r.preventDefault(),t.translate(t.defaultlocale,e,"form","name",t.form.name[t.defaultlocale])}}},[r("svg",{staticClass:"fill-current text-white w-6 h-6 ml-2",attrs:{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 20 20"}},[r("path",{attrs:{d:"M7.41 9l2.24 2.24-.83 2L6 10.4l-3.3 3.3-1.4-1.42L4.58 9l-.88-.88c-.53-.53-1-1.3-1.3-2.12h2.2c.15.28.33.53.51.7l.89.9.88-.88C7.48 6.1 8 4.84 8 4H0V2h5V0h2v2h5v2h-2c0 1.37-.74 3.15-1.7 4.12L7.4 9zm3.84 8L10 20H8l5-12h2l5 12h-2l-1.25-3h-5.5zm.83-2h3.84L14 10.4 12.08 15z"}})])])],1)})),t._v(" "),r("text-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.code,label:"Код"},model:{value:t.form.code,callback:function(e){t.$set(t.form,"code",e)},expression:"form.code"}}),t._v(" "),r("text-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.encoding,label:"Кодировка"},model:{value:t.form.encoding,callback:function(e){t.$set(t.form,"encoding",e)},expression:"form.encoding"}}),t._v(" "),r("label",{staticClass:"inline-flex items-center md:pb-5 lg:pb-0"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.status,expression:"form.status"}],staticClass:"form-checkbox h-6 w-6 text-indigo-600 shadow-none border-indigo-600",attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(t.form.status)?t._i(t.form.status,null)>-1:t._q(t.form.status,"1")},on:{change:function(e){var r=t.form.status,n=e.target,a=n.checked?"1":"0";if(Array.isArray(r)){var s=t._i(r,null);n.checked?s<0&&t.$set(t.form,"status",r.concat([null])):s>-1&&t.$set(t.form,"status",r.slice(0,s).concat(r.slice(s+1)))}else t.$set(t.form,"status",a)}}}),t._v(" "),r("span",{staticClass:"ml-3 text-lg"},[t._v("Статус")])]),t._v(" "),r("label",{staticClass:"inline-flex items-center md:pb-5 lg:pb-0"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.form.is_default,expression:"form.is_default"}],staticClass:"form-checkbox h-6 w-6 text-indigo-600 ml-6 active:shadow-none border-indigo-600",attrs:{type:"checkbox","true-value":"1","false-value":"0"},domProps:{checked:Array.isArray(t.form.is_default)?t._i(t.form.is_default,null)>-1:t._q(t.form.is_default,"1")},on:{change:function(e){var r=t.form.is_default,n=e.target,a=n.checked?"1":"0";if(Array.isArray(r)){var s=t._i(r,null);n.checked?s<0&&t.$set(t.form,"is_default",r.concat([null])):s>-1&&t.$set(t.form,"is_default",r.slice(0,s).concat(r.slice(s+1)))}else t.$set(t.form,"is_default",a)}}}),t._v(" "),r("span",{staticClass:"ml-3 text-lg"},[t._v("Язык по-умолчанию")])])],2),t._v(" "),r("div",{staticClass:"px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-end items-center"},[r("loading-button",{staticClass:"btn-indigo text-white hover:bg-red-600 focus:bg-red-600",attrs:{loading:t.sending,type:"submit"}},[t._v("Сохранить")])],1)])])])}),[],!1,null,null,null);e.default=c.exports},Z84v:function(t,e,r){"use strict";var n={props:{loading:Boolean}},a=r("KHd+"),s=Object(a.a)(n,(function(){var t=this.$createElement,e=this._self._c||t;return e("button",{staticClass:"flex items-center",attrs:{disabled:this.loading}},[this.loading?e("div",{staticClass:"btn-spinner mr-2"}):this._e(),this._v(" "),this._t("default")],2)}),[],!1,null,null,null);e.a=s.exports},"pF+r":function(t,e,r){"use strict";var n={inheritAttrs:!1,props:{id:{type:String,default:function(){return"text-input-".concat(this._uid)}},type:{type:String,default:"text"},value:String,label:String,errors:{type:Array,default:function(){return[]}}},methods:{focus:function(){this.$refs.input.focus()},select:function(){this.$refs.input.select()},setSelectionRange:function(t,e){this.$refs.input.setSelectionRange(t,e)}}},a=r("KHd+"),s=Object(a.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.label?r("label",{staticClass:"form-label",attrs:{for:t.id}},[t._v(t._s(t.label)+":")]):t._e(),t._v(" "),r("input",t._b({ref:"input",staticClass:"form-input",class:{error:t.errors.length},attrs:{id:t.id,type:t.type},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},"input",t.$attrs,!1)),t._v(" "),t.errors.length?r("div",{staticClass:"form-error"},[t._v(t._s(t.errors[0]))]):t._e()])}),[],!1,null,null,null);e.a=s.exports}}]);
//# sourceMappingURL=59.chunk.5498bb7000b4239116fd.js.map