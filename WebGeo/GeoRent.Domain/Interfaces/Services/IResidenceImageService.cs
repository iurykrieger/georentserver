using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IResidenceImageService : IDisposable
    {
        ResidenceImage Add(ResidenceImage obj);
        ResidenceImage Update(ResidenceImage obj);
        void Remove(Guid id);
        ResidenceImage GetById(Guid id);
        IEnumerable<ResidenceImage> GetAll();
        int SaveChanges();

    }
}