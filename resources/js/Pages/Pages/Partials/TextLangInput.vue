<template>
    <div class="col-12 mb-3 text-lang-input my-2 py-2">
        <div class="row m-0">
            <div class="col-sm-4 col-md-2 title-form-block">
                <p><b>{{ title }}</b></p>
            </div>
            <div class="col-sm-8 col-md-10">
                <div v-for="(language, index) in $page.props.languages" :key="language.id" class=" mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">{{ language.locale }} </span>
                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="" v-model="modelValue[index][name]">
                    </div>
                    <div class="mb-2 alert alert-danger" v-if="errors !== undefined && errors['languages.' + index +'.' + name]">
                        {{ errors['languages.' + index +'.' + name] }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .text-lang-input{
        border: 1px solid #dcdcdc;
    }
</style>

<script setup>
import { usePage }  from "@inertiajs/vue3";
const page = usePage();

const { modelValue, name, languages, title, errors} = defineProps(['modelValue', 'name', 'languages', 'title', 'errors']);

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


//modelValue.push({language: 'en', title: '', content: '', tag_title: '', description: ''});

//const { 'update:modelValue': updateModelValue } = defineEmits(['update:modelValue']);

// Слушаем изменения в modelValue и отправляем их в родительский компонент
// const updateTitle = (index, value) => {
//   modelValue[index][name] = value;
//   updateModelValue([...modelValue]); // Отправляем обновленный массив
// };
</script>
