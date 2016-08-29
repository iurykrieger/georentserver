using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class MatchService : IMatchService
    {
        private readonly IMatchRepository _matchRepository;

        public MatchService(IMatchRepository MatchRepository)
        {
            _matchRepository = MatchRepository;
        }

        public Match Add(Match obj)
        {
            return _matchRepository.Add(obj);
        }

        public void Dispose()
        {
            _matchRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<Match> GetAll()
        {
            return _matchRepository.GetAll();
        }

        public Match GetById(Guid id)
        {
            return _matchRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _matchRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _matchRepository.SaveChanges();
        }

        public Match Update(Match obj)
        {
            throw new NotImplementedException();
        }
    }
}
