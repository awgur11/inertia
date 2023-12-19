<script setup>

import { ref } from 'vue';
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
    pages: {
        type: Object,
        default: () => ({}),
    },

});

const data = 'page1';







</script>

<template>

<!-- <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Logo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item" v-for="page in pages" :key="page.id">
                <Link :href="route('page', page.alt_title)" class="nav-link" :class="{ 'active' : $page.url === '/' + page.alt_title }">{{ page.language.title }}</Link>
            </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>  
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Dropdown</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Link</a></li>
            <li><a class="dropdown-item" href="#">Another link</a></li>
            <li><a class="dropdown-item" href="#">A third link</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav> -->
    <nav class="navbar navbar-expand-sm bg-light justify-content-center">
        <div class="container-fluid">
        	<Link :href="route('site.index')" class="navbar-brand">Logo</Link>
        </div>
        <ul class="navbar-nav">
            <li class="nav-item" v-for="page in pages" :key="page.id">
                <Link :href="route('page', page.alt_title)" class="nav-link" :class="{ 'active' : $page.url === '/' + page.alt_title }">{{ page.language.title }}</Link>
            </li>
        </ul>
    </nav>
</template>
