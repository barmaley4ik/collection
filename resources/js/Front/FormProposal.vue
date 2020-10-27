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
            <label for="studio">{{ labelStudio }}</label> 
            <label class="error">{{errors.studio}}</label>
            <input v-model="form.studio" id="studio" name="studio" type="text" class="form-control">

          </div>            
        </div>
        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
            <label for="country_id">{{ labelCountry }}</label>
            <label class="error">{{errors.country}}</label> 
              <select v-model="form.country_id" id="country_id" name="country_id" class="select form-control">
                <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
              </select>
          </div>
          <div class="form-group col-5">
            <label for="city">{{ labelCity }}</label> 
            <label class="error">{{errors.city}}</label>
            <input v-model="form.city" id="city" name="city" type="text" class="form-control">
            
          </div>  
        </div>
        <div class="form-row">
          <div class="form-group col-5" style="z-index: 1;">
            <label for="specialization_id">{{ labelSpecialization }}</label> 
            <select v-model="form.specialization_id" id="specialization_id" name="specialization_id" class="form-control">
              <option v-for="specialization in specializations" :key="specialization.id" :value="specialization.id">{{ specialization.name }}</option>
            </select>
          </div>            
          <div class="form-group col-5">
            <label for="phone" class="control-label">{{ labelPhone }}</label> 
            <label class="error">{{errors.phone}}</label>
            <input v-model="form.phone" id="phone" name="phone" type="text" class="form-control">
            
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
<!--           <div class="form-group col-5" style="z-index: 1;">
          <label for="count_worker">{{labelCountWorker}}</label>
          <label class="error">{{errors.count_worker}}</label>   
            <input v-model.number="form.count_worker" id="count_worker" name="count_worker" type="text" pattern="[\d]{9}" class="form-control">
          </div> -->
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
          <div class="form-group col-5" style="z-index: 1;">
            <label for="logo">{{labelProfile}}</label>
            <label class="error">{{errors.logo}}</label>              
            <input @change="processFile()" type="file" name="logo" id="logo" ref="logo" accept=".jpg, .jpeg, .png" size="1048576">
          </div>
          <div class="form-group col-5">
            <label for="portfolio">{{labelPortfolio}}</label> 
            <label class="error">{{errors.portfolio}}</label>                
            <input @change="processManyFile()" type="file" name="portfolio" id="portfolio" ref="portfolio" accept=".jpg, .jpeg, .png" multiple size="1048576">
          </div>            
        </div>                                                          
<!--         <div class="form-row">
          <br>
          <div class="form-group col-5"> 


          </div>
          <div class="form-group col-5"> 

          </div>          
        </div> -->
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
              <button v-on:click.stop.prevent="onSubmit()" name="submit" class="btn" style="background-color: black;border: none;color: white; padding: 10 15; outline: none;">{{labelSend}}</button>
            </div>
        </div>                       
      </form>
  </div> 
</template>

<script>


export default {
  props: {
    festival_id: String,  
    countries: Array,  
    specializations: Array,
    placeformats: Array,
    language_id: String,
    labelMemberName: String,  
    labelStudio: String,  
    labelCountry: String,  
    labelCity: String,  
    labelComment: String,  
    labelPhone: String,  
    labelProfile: String,  
    labelPortfolio: String,  
    labelPlaceFormat: String,  
    labelSpecialization: String,  
    labelSpecialization: String,  
    labelCountWorker: String,  
    labelPlaceNumber: String,
    labelProposalAttention: String,
    errorFilesize: String,
    errorFileext: String,
    errorRequired: String,
    errorMail: String,
    errorHeaderPart: String,
    labelSend: String,
    
  },  
  data() {
    return {
    form:{ 
    country_id: this.countries.length> 0 ? this.countries[0].id : null,
    festival_id: this.festival_id,
    specialization_id: this.specializations.length> 0 ? this.specializations[0].id : null,
    place_format_id: this.placeformats.length> 0 ? this.placeformats[0].id : null,
    language_id: this.language_id,
    member: null,
    studio: null,
    city: null,
    social: {
      "facebook": '',
      "instagram": '',
      "email": '',
      "website": '',
    },
    place_number: null,
    phone: null,
    logo: null,
    portfolio: [],
    count_worker: 1,
    comment: ' ',
    status_id: 1,
 
    },
    logo: null,
    portfolio: [],
    splitTexts: this.labelProposalAttention.split(';'),
    errors: {},
    message: null,
    typeMessage: true,
    }
  },
    methods: {

      processFile() {
        this.form.logo = this.$refs.logo.files[0];
      },

      processManyFile() {
          for( var i = 0; i < this.$refs.portfolio.files.length; i++ ){
          this.form.portfolio.push(this.$refs.portfolio.files[i] );
        }             
      },  

/*       onClose(){
       this.form.show=false;
       setTimeout(() => { this.form.show=true },3000); 
      }, */

      onSubmit(){

        for (var key in this.errors)
        {
          if (this.errors.hasOwnProperty(key)) 
          {
            Vue.delete( this.errors, key )
          }
        }

        Vue.set(this, 'message', null );

        if (this.form.portfolio.length > 0) { 
            for (var i = 0; i <= this.form.portfolio.length - 1; i++) { 
  
                const fsize = this.form.portfolio[i].size; 
                const fname = this.form.portfolio[i].name; 
                const file = Math.round((fsize / 1024)); 
 
                if (file >= 1025) { 
                  Vue.set(this.errors, 'portfolio', fname+' - ' + this.errorFilesize)
                  Vue.set(this.form, 'portfolio', [])
                } 
            } 
        } 
        if (this.form.logo) { 
  
          const fsize = this.form.logo.size; 
          const fname = this.form.logo.name; 
          const file = Math.round((fsize / 1024)); 

          if (file >= 1025) { 
            Vue.set(this.errors, 'logo', fname+' - ' + this.errorFilesize)
            Vue.set(this.form, 'logo', null)
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

        if(!this.form.studio) {
          Vue.set(this.errors, 'studio', this.errorRequired)
        } 

        if(!this.form.city) {
          Vue.set(this.errors, 'city', this.errorRequired)
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
                } else if (key =='portfolio') {
                  for( var i = 0; i < this.form.portfolio.length; i++ ){
                    let file = this.form.portfolio[i];
                    formData.append('portfolio[' + i + ']', file);
                  }
                } else
                {
                  formData.append(key, value);
                  }
              });
           //   formData.append(social, JSON.stringify(social));

   
      this.axios.post('/store-proposal', formData, 
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
.error {
  color: red !important;
  font-size: 16px;
}
.success-msg {
  color:#4ce088 !important;
  font-size: 16px !important;
}
</style>