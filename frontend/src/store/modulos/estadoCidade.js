import EstadoCidadeervice from '../../services/estadoCidade.service'

export default{
    state:{
        estados:[],
        cidades:[],
        loadingEstado:false,
        loadingCidade:false,
    },
    getters:{
        getEstados(state){
            return state.estados
        },
        getCidades(state){
            return state.cidades
        },
        loadingEstado(state){
            return state.loading
        },
        loadingCidade(state){
            return state.loading
        }

    },
    mutations:{
        updateEstados(state, payload) {
            state.estados = payload;
        },
        updateCidades(state, payload) {
            state.cidades = payload;
        },
        loadingEstado(state, payload){
            state.loading = payload
        },
        loadingCidade(state, payload){
            state.loading = payload
        }
    },
    actions:{

        consultaEstados({commit}){
            commit('loadingEstado',true)
            EstadoCidadeervice.listEstados()
                .then((response) => {
                  commit('updateEstados', response.data.data)
                  commit('loadingEstado',false)
                })
                .catch((e) => {
                    commit('loadingEstado',false)
                });
        },
        consultaCidades({commit},payload){
            commit('loadingCidade',true)
            EstadoCidadeervice.listCidades(payload)
                .then((response) => {
                  commit('updateCidades', response.data.data)
                  commit('loadingCidade',false)
                })
                .catch((e) => {
                    commit('loadingCidade',false)
                });
        }
       
    }
}