using System;
using System.Runtime.Serialization;

namespace GeoRentWebService.Entities
{
    [DataContract]
    public class LocationEntity
    {
        public LocationEntity()
        {
            this.idLocation = idLocation;
        }

        [DataMember]
        public int idLocation { get; set; }
        [DataMember]
        public string latitude { get; set; }
        [DataMember]
        public int longitude { get; set; }
        [DataMember]
        public virtual CityEntity idCity { get; set; }
    }
}