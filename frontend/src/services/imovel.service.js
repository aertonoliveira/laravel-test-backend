import ApiService from './api.service'

class ImovelService  {
  
 

  listImovel(page = 1) {
    return ApiService.get(`imovel?page=${page}`);
  }

  consultarImoveisNaoAssociados() {
    return ApiService.get('imovel/nao_associado');
  }

  cadastrarImovel(data) {
    return ApiService.post('imovel', data);
  }

  countImoveis() {
    return ApiService.get('imoveis');
  }

  excluirImovel(id) {
    return ApiService.delete(`imovel/${id}`);
  }

  
}

export default new ImovelService()
