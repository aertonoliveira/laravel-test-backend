import ApiService from './api.service'

class EstadoCidadeervice {
 
 
  listEstados() {
    return ApiService.get(`/estado`);
  }

  listCidades(estado) {
    return ApiService.get(`/estado/cidade/${estado}`);
  }
 
}

export default new EstadoCidadeervice()
