import ContratoService from '../../services/contrato.service'
import Utils from '../../utils/utils' 
import Vue from "vue";

export default{
    state:{
        loading_cadastro:false,
        count_contratos:0
    },
    mutations:{
        loadingCadastro(state, payload) {
            state.loading_cadastro = payload;
        },
        countContratos(state, payload) {
            state.count_contratos = payload;
        },
    },
    actions:{
        cadastrarContrato({commit,dispatch },payload){
            commit('loadingCadastro',true)
            ContratoService.cadastrarContrato(payload)
                .then(() => {
                  commit('loadingCadastro',false)
                  Vue.$toast.success("Contrato Realizado com Sucesso!")
                //   Vue.$refs['contrato-modal'].hide()
                  dispatch('consultarImoveis');
                  dispatch('countImoveis');
                  dispatch('countContratos');
                })
                .catch((e) => {  
                    commit('loadingCadastro',false)    
                    Vue.$toast.error(Utils.mensagemErro(e.response.data.errors));          
                });
        },
        countContratos({commit}){
            ContratoService.conutContratos()
            .then((response) => {
              commit('countContratos', response.data.data)
            })
            .catch((e) => {
                Vue.$toast.error(Utils.mensagemErro(e.response.data.errors));          
            });
        }
        
    }
}