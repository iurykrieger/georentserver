using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class LocationService : ILocationService
    {
        private readonly ILocationRepository _locationRepository;

        public LocationService(ILocationRepository LocationRepository)
        {
            _locationRepository = LocationRepository;
        }

        public Location Add(Location obj)
        {
            return _locationRepository.Add(obj);
        }

        public void Dispose()
        {
            _locationRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<Location> GetAll()
        {
            return _locationRepository.GetAll();
        }

        public Location GetById(Guid id)
        {
            return _locationRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _locationRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _locationRepository.SaveChanges();
        }

        public Location Update(Location obj)
        {
            throw new NotImplementedException();
        }
    }
}
