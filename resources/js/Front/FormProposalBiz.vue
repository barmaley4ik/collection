<template>
   <div class="form-proposal">
      <form>
        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
            <label for="member">{{ labelMemberName }}</label>
            <label class="error">{{errors.member}}</label> 
            <input v-model="form.member" id="member" name="member" type="text" class="form-control">
          </div>
          <div class="form-group col-5">
            <label for="specialization_id">{{ labelSpecialization }}</label> 
            <select v-model="form.specialization_id" id="specialization_id" name="specialization_id" class=" select form-control">
              <option v-for="specialization in specializations" :key="specialization.id" :value="specialization.id">{{ specialization.name }}</option>
            </select>
          </div>        
        </div>
        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
          <label for="count_worker">{{labelCountWorker}}</label>
          <label class="error">{{errors.count_worker}}</label>   
            <input v-model.number="form.count_worker" id="count_worker" name="count_worker" type="text" pattern="[\d]{9}" maxlength="3" class="form-control">
          </div>
          <div class="form-group col-5">
            <label for="fitting_room">
                {{labelFittingRoom}}
            </label>
            <br>
            <input v-model="form.fitting_room" type="checkbox" class="form-check-input" id="fitting_room">
          </div>  
        </div>        
        <div class="form-row">
          <div class="form-group col-10">  
          <label for="comment">{{ labelProduct }}</label>
          <label class="error">{{errors.product}}</label> 
            <textarea v-model="form.product" id="product" name="product" rows="3" class="form-control"></textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
            <label for="email" class="control-label">Email</label> 
            <label class="error">{{errors.mail}}</label>
            <input v-model="form.social.email"  id="email" name="email" type="email" class="form-control">
          </div>             
          <div class="form-group col-5">
            <label for="website">Website</label> 
            <input v-model="form.social.website"  id="website" name="website" type="text" class="form-control">
          </div>
          </div>
        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
            <label for="instagram">Instagram</label> 
            <input v-model="form.social.instagram"  id="instagram" name="instagram" type="text" class="form-control">
          </div>
          <div class="form-group col-5">
            <label for="facebook">Facebook</label> 
            <input v-model="form.social.facebook" id="facebook" name="facebook" type="text" class="form-control">
          </div>  
        </div>        
        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
            <label for="phone" class="control-label">{{ labelPhone }}</label> 
            <label class="error">{{errors.phone}}</label>
            <input v-model="form.phone" id="phone" name="phone" type="text" class="form-control">            

          </div>            
          <div class="form-group col-5">
            <label for="phone" class="control-label">{{ labelIllumination }}</label> 
            <label class="error">{{errors.illumination}}</label>
            <input v-model="form.illumination" id="illumination" name="illumination" type="text" pattern="[\d]{9}" maxlength="4" class="form-control">     
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
          <label for="place_format">{{labelPlaceFormat}}</label> 
            <select v-model="form.place_format_id" id="place_format" name="place_format" class="select form-control">
              <option v-for="placeformat in placeformats" :key="placeformat.id" :value="placeformat.id">{{ placeformat.name }}</option>
            </select>
          </div>
          <div class="form-group col-5">
          <label for="place_number">{{labelPlaceNumber}}</label>
          <label class="error">{{errors.place_number}}</label> 
            <input v-model="form.place_number" id="place_number" name="place_number" type="text" class="form-control">
            
          </div>  
        </div>
        <div class="form-row">
          <div class="form-group col-10" style="z-index: 1;">
            <label for="fotos">{{labelFotos}}</label>
            <label class="error">{{errors.fotos}}</label>              
            <input @change="processManyFile()" type="file" name="fotos" id="fotos" ref="fotos" accept=".jpg, .jpeg, .png" multiple size="1048576">
          </div>            
        </div>                                                          
        <div class="form-row">
          <div class="form-group col-10">  
          <label for="comment">{{ labelComment }}</label> 
            <textarea v-model="form.comment" id="comment" name="comment" rows="3" class="form-control"></textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-10" v-for="text of splitTexts">  
            <span>{{text}}</span>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-10">  
            <span v-bind:class="(typeMessage) ? 'success-msg' : 'error'" >{{message}}</span>
          </div>
        </div>        
        <div class="form-row">
            <div class="form-group col-10" style="text-align:center; padding:10;">
              <button v-on:click.stop.prevent="onSubmit()" name="submit" class="btn" style="background-color: black;border: none;color: white; padding: 10 15; outline: none;">Отправить</button>
            </div>
        </div>                       
      </form>
  </div> 
</template>

<script>


export default {
  props: {
    festival_id: String,  
    specializations: Array,
    placeformats: Array,
    language_id: String,
    labelMemberName: String, 
    labelIllumination: String,
    labelComment: String,  
    labelProduct: String,  
    labelPhone: String,  
    labelFotos: String,  
    labelPlaceFormat: String,  
    labelSpecialization: String,  
    labelSpecialization: String,  
    labelCountWorker: String,  
    labelPlaceNumber: String,
    labelFittingRoom: String,
    labelProposalAttention: String,
    errorFilesize: String,
    errorFileext: String,
    errorRequired: String,
    errorMail: String,
    errorHeaderPart: String,
    errorProduct: String,
    
  },  
  data() {
    return {
    form:{ 
    festival_id: this.festival_id,
    specialization_id: this.specializations.length> 0 ? this.specializations[0].id : null,
    place_format_id: this.placeformats.length> 0 ? this.placeformats[0].id : null,
    language_id: this.language_id,
    member: null,
    product: ' ',
    illumination: null,
    fitting_room: 0,
    social: {
      "facebook": '',
      "instagram": '',
      "email": '',
      "website": '',
    },
    place_number: null,
    phone: null,
    fotos: [],
    count_worker: 1,
    comment: ' ',
    status_id: 1,
 
    },
    splitTexts: this.labelProposalAttention.split(';'),
    errors: {},
    message: null,
    typeMessage: true,
    }
  },
    methods: {
      processManyFile() {
          for( var i = 0; i < this.$refs.fotos.files.length; i++ ){
          this.form.fotos.push(this.$refs.fotos.files[i] );
        }             
      },  

      onSubmit(){

        for (var key in this.errors)
        {
          if (this.errors.hasOwnProperty(key)) 
          {
            Vue.delete( this.errors, key )
          }
        }

        Vue.set(this, 'message', null );

        if (this.form.fotos.length > 0) { 
            for (var i = 0; i <= this.form.fotos.length - 1; i++) { 
  
                const fsize = this.form.fotos[i].size; 
                const fname = this.form.fotos[i].name; 
                const file = Math.round((fsize / 1024)); 
 
                if (file >= 1025) { 
                  Vue.set(this.errors, 'fotos', fname+' - ' + this.errorFilesize)
                  Vue.set(this.form, 'fotos', [])
                } 
            } 
        } 

        function validateEmail(email) {
              var re = /\S+@\S+\.\S+/;
              return re.test(email);
          }

        if(this.form.social.email) {
          if (!validateEmail(this.form.social.email)) {
            Vue.set(this.errors, 'mail', this.errorMail)
          }     
        } else {
          Vue.set(this.errors, 'mail', this.errorRequired)
        } 

        if(!this.form.member) {
          Vue.set(this.errors, 'member', this.errorRequired)
        }

        if(!this.form.product.trim()) {
          Vue.set(this.errors, 'product', this.errorRequired)
        }

        if(!this.form.phone) {
          Vue.set(this.errors, 'phone', this.errorRequired)
        } 

        if(!this.form.place_number) {
          Vue.set(this.errors, 'place_number', this.errorRequired)
        } 

        if(!this.form.count_worker) {
          Vue.set(this.errors, 'count_worker', this.errorRequired)
        } 
         
      if (Object.keys(this.errors).length == 0) {
          console.log('ошибок нет на фронте');
/*           let formData = new FormData();
          formData.append('logo', this.form.logo);
          formData.append('member', this.form.member); */
          var social = this.form.social;
              const formData = new FormData();
              //Object.keys(this.form).forEach(key => formData.append(key, this.form[key]));
              Object.entries(this.form).forEach(([key, value]) => {
                if (key =='social') {
                    formData.append(key, JSON.stringify(value))
                } else if (key =='fotos') {
                  for( var i = 0; i < this.form.fotos.length; i++ ){
                    let file = this.form.fotos[i];
                    formData.append('fotos[' + i + ']', file);
                  }
                } else
                {
                  formData.append(key, value);
                  }
              });

   
      this.axios.post('/store-biz-proposal', formData, 
          {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
          }
      ).then(response => {
          console.log(response.data);

          setTimeout(() => { Object.assign(this.$data, this.$options.data.apply(this)) },3000); 
          this.message =  response.data.success;
          this.typeMessage = true;

      }
      ).catch(error =>{
        this.message = this.errorHeaderPart + ' '+ error.response.data.message;
        this.typeMessage = false;
      // console.log(error.response);
      })       
      }                           
   
      },
    }, 
  

}
</script>
<style scope>

  .form-group {
    padding: 10 0 5 0;

  }
.form-row {
  padding: 10 10 0 10;
}

.col-10 span {
  font-size: 14px;
  color: white;
/*   background-color: white; */
}
.col-5, .col-10 label {
  color:white;

}
.col-5 select {
  color:#282b2d ;

}
.col-5, .col-10  {
margin-bottom: 0 !important; 
}

input[type="file"] {
  color:white;
  
}
input[type="checkbox"] {
  transform: scale(2);
  margin: 10;
  
}    
.error {
  color: red !important;
  font-size: 16px;
}
.success-msg {
  color:#4ce088 !important;
  font-size: 16px !important;
}
.select {
  margin-top: 5px;
}
</style>