using GeoRentWebService.Entities;
using System;
using System.Collections.Generic;
using System.Linq;

namespace GeoRentWebService.Repository
{
    public class CityRepository
    {
        private georentdbEntities context = new georentdbEntities();

        private city citys = new city();

        public void Insert(CityEntity cityEntity)
        {
            citys.name = cityEntity.Name;
            citys.UF = cityEntity.UF;

            context.cities.Add(citys);
            context.SaveChanges();
        }

        //ATUALIZANDO UM REGISTRO EXISTENTE
        public void Update(CityEntity cityEntity)
        {
            using (context)
            {
                citys = context.cities.Where(n => n.idCity == cityEntity.IdCity).First();
                
                citys.name = cityEntity.Name;
                citys.UF = cityEntity.UF;

                context.SaveChanges();
            }

        }

        public void Remove(Int32 id)
        {
            citys = (from n in context.cities
                                   where n.idCity == id
                                   select n).First();
            //Exclui um registro ativo
            context.cities.Remove(citys);
            context.SaveChanges();
        }

        //Consulta usuario pelo código
        public CityEntity GetById(Int32 id)
        {
            CityEntity cityEntity = new CityEntity();

            city cities = (from n in context.cities
                                   where n.idCity == id
                                   select n).First();

            cityEntity.IdCity = cities.idCity;
            cityEntity.Name = cities.name;
            cityEntity.UF = cities.UF;

            return cityEntity;
        }
        
        public IList<CityEntity> GetAll()
        {
            IList<CityEntity> listaCityEntity = new List<CityEntity>();

            IList<city> citie = (from n in context.cities
                              select n).ToList();

            CityEntity cityEntity = null;

            foreach (city cities in citie)
            {

                cityEntity = new CityEntity();
                cityEntity.IdCity = cities.idCity;
                cityEntity.Name = cities.name;
                cityEntity.UF = cities.UF;

                listaCityEntity.Add(cityEntity);
            }

            return listaCityEntity;
        }
    }
}