using System;
using System.Collections.Generic;
using GeoRent.Domain.Entities;
using GeoRent.Domain.Interfaces.Repository;
using GeoRent.Domain.Interfaces.Services;

namespace GeoRent.Domain.Services
{
    public class LikeService : ILikeService
    {
        private readonly ILikeRepository _LikeRepository;

        public LikeService(ILikeRepository LikeRepository)
        {
            _LikeRepository = LikeRepository;
        }

        public Like Add(Like obj)
        {
            return _LikeRepository.Add(obj);
        }

        public void Dispose()
        {
            _LikeRepository.Dispose();
            GC.SuppressFinalize(this);
        }

        public IEnumerable<Like> GetAll()
        {
            return _LikeRepository.GetAll();
        }

        public Like GetById(Guid id)
        {
            return _LikeRepository.GetById(id);
        }

        public void Remove(Guid id)
        {
            _LikeRepository.Remove(id);
        }

        public int SaveChanges()
        {
            return _LikeRepository.SaveChanges();
        }

        public Like Update(Like obj)
        {
            throw new NotImplementedException();
        }
    }
}
