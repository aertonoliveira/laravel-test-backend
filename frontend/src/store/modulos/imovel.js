import ImovelService from '../../services/imovel.service'
import Utils from '../../utils/utils' 
import Vue from "vue";

export default{
    state:{
        imoveis:[],
        imoveis_nao_associados:[],
        loading_cadastro:false,
        loading_listagem:false,
        per_page:1,
        total_page:1,
        count_imoveis:0

    },
    mutations:{
        updateImoveis(state, payload) {
            state.imoveis = payload.data;
            state.per_page = payload.per_page;
            state.total_page = payload.last_page * 10;
        },
        loadingCadastro(state, payload) {
            state.loading_cadastro = payload;
        },
        loadingListagem(state, payload) {
            state.loading_listagem = payload;
        },
        updateImoveisNaoAssociado(state, payload){
            state.imoveis_nao_associados = payload;
        },
        updateCountImoveis(state, payload) {
            state.count_imoveis = payload;
        }, 
    },
    actions:{
        cadastrarImovel({commit,dispatch },payload){
            commit('loadingCadastro',true)
            ImovelService.cadastrarImovel(payload)
                .then(() => {
                  commit('loadingCadastro',false)
                  Vue.$toast.success("Imovel Cadastrado com Sucesso!")
                  dispatch('consultarImoveis');
                  dispatch('countImoveis');
                  dispatch('countContratos');
                })
                .catch((e) => {  
                    commit('loadingCadastro',false)    
                    Vue.$toast.error(Utils.mensagemErro(e.response.data.errors));          
                });
        },
        consultarImoveis({commit},page){
            commit('loadingListagem',true)
            ImovelService.listImovel(page)
                .then((response) => {
                  commit('updateImoveis', response.data)
                  commit('loadingListagem',false)
                })
                .catch((e) => {
                    Vue.$toast.error(Utils.mensagemErro(e.response.data.errors));  
                    commit('loadingListagem',false)        
                });
        },
        consultarImoveisNaoAssociados({commit}){
            ImovelService.consultarImoveisNaoAssociados()
            .then((response) => {
              commit('updateImoveisNaoAssociado', response.data.data)
              
            })
            .catch((e) => {
                Vue.$toast.error(Utils.mensagemErro(e.response.data.errors));          
            });
        },
        countImoveis({commit}){
            ImovelService.countImoveis()
            .then((response) => {
              commit('updateCountImoveis', response.data.data)
            })
            .catch((e) => {
                Vue.$toast.error(Utils.mensagemErro(e.response.data.errors));          
            });
        },
        excluirImovel({dispatch},payload){
            ImovelService.excluirImovel(payload)
            .then(() => {
                dispatch('consultarImoveis');
                dispatch('countImoveis');
                dispatch('countContratos');

            })
            .catch((e) => {
                Vue.$toast.error(Utils.mensagemErro(e.response.data.errors));          
            });
        }

    }
}