using GeoRent.Domain.Entities;
using System.Data.Entity.ModelConfiguration;

namespace GeoRent.Infra.Data.EntityConfig
{
    public class LikeConfig : EntityTypeConfiguration<Like>
    {
        public LikeConfig()
        {
            ToTable("Like");
        }
    }
}