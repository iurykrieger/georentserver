using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IPreferenceService : IDisposable
    {
        Preference Add(Preference obj);
        Preference Update(Preference obj);
        void Remove(Guid id);
        Preference GetById(Guid id);
        IEnumerable<Preference> GetAll();
        int SaveChanges();

    }
}