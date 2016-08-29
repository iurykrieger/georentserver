using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class LocatorService : ILocatorService
    {
        private readonly ILocatorRepository _locatorRepository;

        public LocatorService(ILocatorRepository LocatorRepository)
        {
            _locatorRepository = LocatorRepository;
        }

        public Locator Add(Locator obj)
        {
            return _locatorRepository.Add(obj);
        }

        public IEnumerable<Locator> GetAll()
        {
            return _locatorRepository.GetAll();
        }

        public Locator GetById(Guid id)
        {
            return _locatorRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _locatorRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _locatorRepository.SaveChanges();
        }

        public Locator Update(Locator obj)
        {
            return _locatorRepository.Update(obj);
        }

        public void Dispose()
        {
            _locatorRepository.Dispose();
            GC.SuppressFinalize(this);
        }
    }
}
