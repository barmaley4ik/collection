<template>
  <div>
    <label v-if="label" class="form-label" :for="id">{{ label }}:</label>
    <editor :name="name" :id="id" v-bind="$attrs" :value="value" @onKeyUp="changeEdit(name)" :init="{plugins: 'autolink link image lists hr anchor pagebreak searchreplace visualblocks code insertdatetime media nonbreaking table paste', language: 'ru', skin: 'oxide', branding: false, menubar: 'format', toolbar: 'styleselect | fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code | table'  } " />
    <div v-if="errors.length" class="form-error">{{ errors[0] }}</div>
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
export default {
  components: {
    Editor,
  },

  props: {
    id: {
      type: String,
      default() {
        return `textarea-input-${this._uid}`
      },
    },
    value: String,
    label: String,
    name: String,
    errors: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
        

    }
  },
  methods: {
        changeEdit(name){

          console.log('change'+name + tinymce.activeEditor.getContent())
        },
       
  },

}
</script>
