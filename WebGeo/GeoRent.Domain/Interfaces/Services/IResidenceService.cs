using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IResidenceService: IDisposable
    {
        Residence Add(Residence obj);
        Residence Update(Residence obj);
        void Remove(Guid id);
        Residence GetById(Guid id);
        IEnumerable<Residence> GetAll();
        int SaveChanges();

    }
}