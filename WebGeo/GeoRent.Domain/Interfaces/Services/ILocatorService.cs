using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface ILocatorService : IDisposable
    {
        Locator Add(Locator obj);
        Locator Update(Locator obj);
        void Remove(Guid id);
        Locator GetById(Guid id);
        IEnumerable<Locator> GetAll();
        int SaveChanges();

    }
}