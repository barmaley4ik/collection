(window.webpackJsonp=window.webpackJsonp||[]).push([[58],{Aa5a:function(t,e,s){"use strict";s.r(e);var r=s("+SZM"),a=s("Z84v"),n=s("Ujtf"),l=s("pF+r"),i={components:{Icon:s("MY0P").a}},o=s("KHd+"),u=Object(o.a)(i,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"p-4 bg-yellow-400 rounded flex items-center justify-between max-w-3xl"},[s("div",{staticClass:"flex items-center"},[s("icon",{staticClass:"flex-shrink-0 w-4 h-4 fill-yellow-800 mr-2",attrs:{name:"trash"}}),t._v(" "),s("div",{staticClass:"text-sm font-medium text-yellow-800"},[t._t("default")],2)],1),t._v(" "),s("button",{staticClass:"text-sm text-yellow-800 hover:underline",attrs:{tabindex:"-1",type:"button"},on:{click:function(e){return t.$emit("restore")}}},[t._v("Восстановить")])])}),[],!1,null,null,null).exports,c={metaInfo:function(){return{title:"".concat(this.form.first_name," ").concat(this.form.last_name)}},layout:r.a,components:{LoadingButton:a.a,SelectInput:n.a,TextInput:l.a,TrashedMessage:u},props:{user:Object},remember:"form",data:function(){return{sending:!1,form:{first_name:this.user.first_name,last_name:this.user.last_name,telegram_user_id:this.user.telegram_user_id,email:this.user.email,password:this.user.password,owner:this.user.owner,photo:null}}},methods:{submit:function(){var t=this;this.sending=!0;var e=new FormData;e.append("first_name",this.form.first_name||""),e.append("last_name",this.form.last_name||""),e.append("telegram_user_id",this.form.telegram_user_id||""),e.append("email",this.form.email||""),e.append("password",this.form.password||""),e.append("owner",this.form.owner||""),e.append("photo",this.form.photo||""),e.append("_method","put"),this.$inertia.post(this.route("users.update",this.user.id),e).then((function(){t.sending=!1,0===Object.keys(t.$page.errors).length&&(t.form.photo=null,t.form.password=null)}))},restore:function(){this.$inertia.put(this.route("users.restore",this.user.id))}}},f=Object(o.a)(c,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("div",{staticClass:"mb-8 flex justify-start max-w-3xl"},[s("h1",{staticClass:"font-bold text-3xl"},[s("inertia-link",{staticClass:"text-indigo-400 hover:text-indigo-600",attrs:{href:t.route("users")}},[t._v("Пользователь")]),t._v(" "),s("span",{staticClass:"text-indigo-400 font-medium"},[t._v("/")]),t._v("\n        "+t._s(t.form.first_name)+" "+t._s(t.form.last_name)+"\n      ")],1),t._v(" "),t.user.photo?s("img",{staticClass:"block w-8 h-8 rounded-full ml-4",attrs:{src:t.user.photo}}):t._e()]),t._v(" "),t.user.deleted_at?s("trashed-message",{staticClass:"mb-6",on:{restore:t.restore}},[t._v("\n      Пользователь был удален.\n    ")]):t._e(),t._v(" "),s("div",{staticClass:"bg-white rounded shadow overflow-hidden max-w-3xl"},[s("form",{on:{submit:function(e){return e.preventDefault(),t.submit(e)}}},[s("div",{staticClass:"p-8 -mr-6 -mb-8 flex flex-wrap"},[s("text-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.first_name,label:"Имя"},model:{value:t.form.first_name,callback:function(e){t.$set(t.form,"first_name",e)},expression:"form.first_name"}}),t._v(" "),s("text-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.last_name,label:"Фамилия"},model:{value:t.form.last_name,callback:function(e){t.$set(t.form,"last_name",e)},expression:"form.last_name"}}),t._v(" "),s("text-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.telegram_user_id,label:"Телеграм ID"},model:{value:t.form.telegram_user_id,callback:function(e){t.$set(t.form,"telegram_user_id",e)},expression:"form.telegram_user_id"}}),t._v(" "),s("text-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.email,label:"Email"},model:{value:t.form.email,callback:function(e){t.$set(t.form,"email",e)},expression:"form.email"}}),t._v(" "),s("text-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.password,type:"password",autocomplete:"new-password",label:"Пароль"},model:{value:t.form.password,callback:function(e){t.$set(t.form,"password",e)},expression:"form.password"}}),t._v(" "),s("select-input",{staticClass:"pr-6 pb-8 w-full lg:w-1/2",attrs:{errors:t.$page.errors.owner,label:"Роль"},model:{value:t.form.owner,callback:function(e){t.$set(t.form,"owner",e)},expression:"form.owner"}},[s("option",{domProps:{value:1}},[t._v("Admin")]),t._v(" "),s("option",{domProps:{value:2}},[t._v("SMM")]),t._v(" "),s("option",{domProps:{value:3}},[t._v("Marketing")])])],1),t._v(" "),s("div",{staticClass:"px-8 py-4 bg-gray-100 border-t border-gray-200 flex items-center"},[s("loading-button",{staticClass:"btn-indigo text-white hover:bg-red-600 focus:bg-red-600 ml-auto",attrs:{loading:t.sending,type:"submit"}},[t._v("Сохранить")])],1)])])],1)}),[],!1,null,null,null);e.default=f.exports},Ujtf:function(t,e,s){"use strict";var r={inheritAttrs:!1,props:{id:{type:String,default:function(){return"select-input-".concat(this._uid)}},value:[String,Number,Boolean],label:String,errors:{type:Array,default:function(){return[]}}},data:function(){return{selected:this.value}},watch:{selected:function(t){this.$emit("input",t)}},methods:{focus:function(){this.$refs.input.focus()},select:function(){this.$refs.input.select()}}},a=s("KHd+"),n=Object(a.a)(r,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[t.label?s("label",{staticClass:"form-label",attrs:{for:t.id}},[t._v(t._s(t.label)+":")]):t._e(),t._v(" "),s("select",t._b({directives:[{name:"model",rawName:"v-model",value:t.selected,expression:"selected"}],ref:"input",staticClass:"form-select",class:{error:t.errors.length},attrs:{id:t.id},on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.selected=e.target.multiple?s:s[0]}}},"select",t.$attrs,!1),[t._t("default")],2),t._v(" "),t.errors.length?s("div",{staticClass:"form-error"},[t._v(t._s(t.errors[0]))]):t._e()])}),[],!1,null,null,null);e.a=n.exports},Z84v:function(t,e,s){"use strict";var r={props:{loading:Boolean}},a=s("KHd+"),n=Object(a.a)(r,(function(){var t=this.$createElement,e=this._self._c||t;return e("button",{staticClass:"flex items-center",attrs:{disabled:this.loading}},[this.loading?e("div",{staticClass:"btn-spinner mr-2"}):this._e(),this._v(" "),this._t("default")],2)}),[],!1,null,null,null);e.a=n.exports},"pF+r":function(t,e,s){"use strict";var r={inheritAttrs:!1,props:{id:{type:String,default:function(){return"text-input-".concat(this._uid)}},type:{type:String,default:"text"},value:String,label:String,errors:{type:Array,default:function(){return[]}}},methods:{focus:function(){this.$refs.input.focus()},select:function(){this.$refs.input.select()},setSelectionRange:function(t,e){this.$refs.input.setSelectionRange(t,e)}}},a=s("KHd+"),n=Object(a.a)(r,(function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[t.label?s("label",{staticClass:"form-label",attrs:{for:t.id}},[t._v(t._s(t.label)+":")]):t._e(),t._v(" "),s("input",t._b({ref:"input",staticClass:"form-input",class:{error:t.errors.length},attrs:{id:t.id,type:t.type},domProps:{value:t.value},on:{input:function(e){return t.$emit("input",e.target.value)}}},"input",t.$attrs,!1)),t._v(" "),t.errors.length?s("div",{staticClass:"form-error"},[t._v(t._s(t.errors[0]))]):t._e()])}),[],!1,null,null,null);e.a=n.exports}}]);
//# sourceMappingURL=58.chunk.9281ef6ac6c2078b7476.js.map