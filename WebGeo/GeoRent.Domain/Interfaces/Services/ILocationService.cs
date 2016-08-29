using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface ILocationService : IDisposable
    {
        Location Add(Location obj);
        Location Update(Location obj);
        void Remove(Guid id);
        Location GetById(Guid id);
        IEnumerable<Location> GetAll();
        int SaveChanges();

    }
}