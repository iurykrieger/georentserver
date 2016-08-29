using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;

namespace GeoRent.Domain.Interfaces.Services
{
    public interface IMatchService : IDisposable
    {
        Match Add(Match obj);
        Match Update(Match obj);
        void Remove(Guid id);
        Match GetById(Guid id);
        IEnumerable<Match> GetAll();
        int SaveChanges();

    }
}