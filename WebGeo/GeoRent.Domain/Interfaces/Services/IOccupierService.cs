using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IOccupierService : IDisposable
    {
        Occupier Add(Occupier obj);
        Occupier Update(Occupier obj);
        void Remove(Guid id);
        Occupier GetById(Guid id);
        IEnumerable<Occupier> GetAll();
        int SaveChanges();

    }
}