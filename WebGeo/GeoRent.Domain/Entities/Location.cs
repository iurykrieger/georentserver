using System;

namespace GeoRent.Domain.Entities
{
    public class Location
    {
        public Location()
        {
            idLocation = Guid.NewGuid();
        }

        public Guid idLocation { get; set; }
        public string latitude { get; set; }
        public int longitude { get; set; }
        public virtual City idCity { get; set; }
    }
}