import Vue from 'vue';
import Vuex from 'vuex';
import imovel from './modulos/imovel';
import contrato from './modulos/contrato';
import estadoCidade from './modulos/estadoCidade';

Vue.use(Vuex);

export default new Vuex.Store({


     modules:{imovel,contrato,estadoCidade}
});