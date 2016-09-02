using System;

namespace GeoRent.Domain.Entities
{
    public class Like
    {
        public Like()
        {
            idLike = Guid.NewGuid();
        }

        public Guid idLike { get; set; }
        public bool like { get; set; }
        public DateTime dateTime { get; set; }
        public bool diamond { get; set; }
        public virtual Residence Residence { get; set; }
        public virtual User idUser { get; set; }
    }
}