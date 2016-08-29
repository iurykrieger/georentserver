using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class PreferenceService : IPreferenceService
    {
        private readonly IPreferenceRepository _preferenceRepository;

        public PreferenceService(IPreferenceRepository PreferenceRepository)
        {
            _preferenceRepository = PreferenceRepository;
        }

        public Preference Add(Preference obj)
        {
            return _preferenceRepository.Add(obj);
        }

        public void Dispose()
        {
            _preferenceRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<Preference> GetAll()
        {
            return _preferenceRepository.GetAll();
        }

        public Preference GetById(Guid id)
        {
            return _preferenceRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _preferenceRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _preferenceRepository.SaveChanges();
        }

        public Preference Update(Preference obj)
        {
            throw new NotImplementedException();
        }
    }
}
