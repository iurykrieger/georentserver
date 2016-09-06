using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class CityService : ICityService
    {
        private readonly ICityRepository _cityRepository;

        public CityService(ICityRepository CityRepository)
        {
            _cityRepository = CityRepository;
        }

        public City Add(City obj)
        {
            return _cityRepository.Add(obj);
        }

        public void Dispose()
        {
            _cityRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<City> GetAll()
        {
            return _cityRepository.GetAll();
        }

        public City GetById(Guid id)
        {
            return _cityRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _cityRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _cityRepository.SaveChanges();
        }

        public City Update(City obj)
        {
            throw new NotImplementedException();
        }
    }
}
