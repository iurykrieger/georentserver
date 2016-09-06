using System;
using System.Collections.Generic;
using GeoRentWebService.Interface;
using GeoRentWebService.Repository;
using GeoRentWebService.Entities;
using System.ServiceModel.Activation;

namespace GeoRentWebService.Service
{
    // NOTE: You can use the "Rename" command on the "Refactor" menu to change the class name "CityService" in code, svc and config file together.
    // NOTE: In order to launch WCF Test Client for testing this service, please select CityService.svc or CityService.svc.cs at the Solution Explorer and start debugging.
    [AspNetCompatibilityRequirements(RequirementsMode = AspNetCompatibilityRequirementsMode.Required)]
    public class CityService : ICityService
    {
        CityRepository cityRepository = new CityRepository();       

        public string Insert(CityEntity cityEntity)
        {
            try
            {
                cityRepository.Insert(cityEntity);

                return "Registro inserido com sucesso!";
            }
            catch (Exception ex)
            {
                return "Erro ao inserir o registro: " + ex.Message;
            }
        }

        public string Update(CityEntity cityEntity)
        {
            try
            {
                cityRepository.Update(cityEntity);
                
                return "Registro atualizado com sucesso!";
            }
            catch (Exception ex)
            {
                return "Erro ao atualizar o registro : " + ex.Message;
            }
        }

        public CityEntity GetById(string id)
        {
            return cityRepository.GetById(Convert.ToInt32(id));
        }

        public IList<CityEntity> GetAll()
        {
            return cityRepository.GetAll();
        }

        public string Remove(string id)
        {
            try
            {
                cityRepository.Remove(Convert.ToInt32(id));

                return "Registro excluido com sucesso!";
            }
            catch (Exception ex)
            {
                return "Erro ao excluir o registro : " + ex.Message;
            }
        }
    }
}
