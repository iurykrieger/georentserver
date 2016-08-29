using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class OccupierService : IOccupierService
    {
        private readonly IOccupierRepository _occupierRepository;

        public OccupierService(IOccupierRepository OccupierRepository)
        {
            _occupierRepository = OccupierRepository;
        }

        public Occupier Add(Occupier obj)
        {
            return _occupierRepository.Add(obj);
        }

        public void Dispose()
        {
            _occupierRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<Occupier> GetAll()
        {
            return _occupierRepository.GetAll();
        }

        public Occupier GetById(Guid id)
        {
            return _occupierRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _occupierRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _occupierRepository.SaveChanges();
        }

        public Occupier Update(Occupier obj)
        {
            throw new NotImplementedException();
        }
    }
}
