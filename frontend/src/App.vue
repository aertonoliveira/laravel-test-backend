<template>
  <div id="app">
    <b-navbar toggleable="md" type="dark" class="nav-background">

    <b-navbar-toggle target="nav_collapse"></b-navbar-toggle>

    <b-navbar-brand href="#">Accordous</b-navbar-brand>

    <b-collapse is-nav id="nav_collapse">

    <b-navbar-nav>
      <b-nav-item href="#"  v-b-modal.imovel>Cadastrar Imovel</b-nav-item>
      <b-nav-item href="#" v-b-modal.contrato>Cadastrar Contrato</b-nav-item>
    </b-navbar-nav> 
  </b-collapse>
</b-navbar>

  <b-container>
    
    <imovel-list ></imovel-list>
    
  </b-container>
 

    <b-modal size="lg" ref="imovel-modal"  hide-footer id="imovel" title="Cadastrar Imovel">
      <imovel></imovel>
    </b-modal>

    <b-modal size="lg" ref="contrato-modal" hide-footer id="contrato" title="Cadastrar Contrato">
      <contrato></contrato>
    </b-modal>

  </div>
</template>

<script>
/* eslint-disable */
import ImovelList from './components/ImovelList.vue'
import Imovel from './components/Imovel.vue'
import Contrato from '@/components/Contrato.vue'
import Card from '@/components/Card.vue'
import ImovelService from '@/services/imovel.service'


export default {
  name: 'app',
  props:{
    creatingContract:false,
  },
  components: {
    'imovel': Imovel,
    'imovel-list': ImovelList,
    'contrato': Contrato,
    'card': Card,
    
  },

  methods: {
    
  
  },
 
}
</script>

<style>
  @import url('https://fonts.googleapis.com/css?family=Lato:400,700');

  body {
    background: #3c1053 !important;
    font-family: 'Lato', sans-serif !important;
  }

  .nav-background {
    background: #353535;
  }
</style>
