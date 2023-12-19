<template>
  <div class="col-12 mb-3 text-lang-textarea my-2 py-2">
    <div class="row m-0">
      <div class="col-sm-4 col-md-2 title-form-block">
        <p><b>{{ title }}</b></p>
      </div>
      <div class="col-sm-8 col-md-10">
      <div v-for="(language, index) in page.props.languages" :key="language.id">
        <span class="badge bg-primary">{{ language.locale }}</span>
        <ckeditor v-if="use_editor" :editor="editor" v-model="modelValue[index][name]" :config="editorConfig" />
        <textarea v-else type="text" class="form-control" v-model="modelValue[index][name]" ></textarea>
        <div class="alert alet-danger" v-if="errors">
      
        </div>
      </div>
        

      </div>
    </div>
  </div>
</template>

<style scoped>
  .text-lang-textarea{
    border: 1px solid #dcdcdc;
  }
</style>

<script setup>
//import { defineProps, defineEmits } from 'vue';
 // import ckeditor from '@ckeditor/ckeditor5-vue';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import { usePage }  from "@inertiajs/vue3";
const page = usePage();


const { modelValue, name, title, errors, use_editor } = defineProps({
  modelValue: {
    type: Object,
  }, 
  name: {
    type: String,
  },
  title: {
    type: String,
  }, 
  errors: {
    type: String,
  },
  use_editor: {
    type: Boolean,
    default: false
  }
  });

page.props.languages.forEach(function(item){
    let exists = false
    modelValue.forEach(function(m){
        if(item.locale == m.language)
            exists = true;
    });
    if(!exists)
    {//копируем первый элемент массива
        const firstElement = { ...modelValue[0] };

        for (let key in firstElement) {
            if(!key.includes('id'))
                firstElement[key] = '';
        }

        firstElement.language = item.locale;

        modelValue.push(firstElement);
    }
});

const components = {
  ckeditor: CKEditor,
};

const editor = ClassicEditor;
// const  editorData = '<p>Content of the editor.</p>';
const editorConfig = {};
//const { 'update:modelValue': updateModelValue } = defineEmits(['update:modelValue']);

// Слушаем изменения в modelValue и отправляем их в родительский компонент
// const updateTitle = (index, value) => {
//   modelValue[index][name] = value;
//   updateModelValue([...modelValue]); // Отправляем обновленный массив
// };
</script>
