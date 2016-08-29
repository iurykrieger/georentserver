using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface ICityService : IDisposable
    {
        City Add(City obj);
        City Update(City obj);
        void Remove(Guid id);
        City GetById(Guid id);
        IEnumerable<City> GetAll();
        int SaveChanges();

    }
}